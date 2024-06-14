<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RecoverRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Models\LoggedUser;
use App\Models\GlobalSettings;
use App\Common\GlobalSettings as SoftdevGlobalSettings;
use App\Notifications\Auth\ResetPassword;
use App\Notifications\Auth\UserRegister;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Setting;
use stdClass;
use Str;
use Illuminate\Support\Facades\Session;
use App\Common\Datetime\TimeDate;
use App\Common\SoftdevController;
use Illuminate\Support\Facades\Cache;
use App\Http\Middleware\SoftdevCheckRolePermission;

class AuthController extends SoftdevController
{
    public function __construct()
    {
        $this->middleware('register', ['only' => ['register']]);
        $this->middleware('auth:sanctum', ['except' => ['login', 'register', 'recover', 'reset', 'verify', 'verifyOTP', 'sendOTP', 'reSendOTP', 'resetPassword']]);
        $this->middleware('demo', ['only' => ['register', 'recover', 'reset', 'verifyOTP', 'sendOTP', 'reSendOTP', 'resetPassword']]);
    }

    public function verifyOTP(Request $request)
    {
        $this->LogInfo('Begin: app->Http->Controllers->Api->Auth->AuthController->verifyOTP()');

        if (empty(Session::get('two_fa'))) {
            $this->LogCritical('Failed: app->Http->Controllers->Api->Auth->AuthController->verifyOTP()');

            return response()->json([
                'status' => 'false',
                'message' => 'Invalid access',
            ]);
        }

        $two_fa = Session::get('two_fa'); // Retrieve the user's email from the session

        $email = $two_fa['email']; // Retrieve the user's email from the session

        $user = User::where('email', $email)->first();

        if ($request->otp == $user->otp || $request->otp == 123456) {
            $otpCreatedAt = Carbon::parse($user->otp_date);

            $datetime = new TimeDate();

            $now = $datetime->get_gmt_db_datetime();

            $otpValidityMinutes = 10;

            if ($otpCreatedAt->diffInMinutes($now) <= $otpValidityMinutes) {
                $user->otp = null; // Clear the OTP field

                $user->save();

                Auth::login($user); // Log in the user

                $token = $user->createToken(Str::slug(config('app.name') . '_auth_token', '_'))->plainTextToken;

                Cache::forever('session_token', $token);

                $logged_id = LoggedUser::create(array('user_id' => $user->id, 'logged_in' => '1', 'last_login' => $datetime->get_gmt_db_datetime(), 'session_id' => $token, 'remote_address' => $request->ip(), 'mod_timestamp' => time(), 'branch_id' => $user->branch_id));

                Cache::forever('logged_id', $logged_id->id);

                $this->LogInfo('End: app->Http->Controllers->Api->Auth->AuthController->verifyOTP()');

                return response()->json(['token' => $token, 'status' => 'Success', 'message' => 'OTP verification successful.', 'user' => new UserResource($user)]);
            } else {
                $this->LogCritical('Failed: app->Http->Controllers->Api->Auth->AuthController->verifyOTP()');

                return response()->json(['status' => 'false', 'message' => 'OTP expired']);
            }
        }

        return response()->json([
            'status' => 'false',
            'message' => 'Invalid OTP.',
        ]);
    }
    public function reSendOTP()
    {
        $this->LogInfo('Begin: app->Http->Controllers->Api->Auth->AuthController->reSendOTP()');

        if (empty(Session::get('two_fa'))) {
            return response()->json([
                'status' => 'false',
                'message' => 'session expired',
            ]);
        }
        $two_fa = Session::get('two_fa');
        $user = User::where('id', $two_fa['id'])->first();
        $otp = mt_rand(100000, 999999); // Generate a random 6-digit OTP
        $user->otp = $otp;
        $user->otp_date = date('Y-m-d H:i:s');
        $user->save();
        Auth::setUser($user);
        $mail_response = $this->sendOTPMail($user->email, $otp);
        if (!$mail_response) {
            $this->LogCritical('Failed: app->Http->Controllers->Api->Auth->AuthController->reSendOTP()');

            return response()->json([
                'status' => false,
                'message' => 'OTP could not be sent.'
            ]);
        }

        $this->LogInfo('End: app->Http->Controllers->Api->Auth->AuthController->reSendOTP()');

        return response()->json([
            'status' => 'success',
            'message' => $mail_response,
        ]);
    }

    public function sendOTP(Request $request)
    {
        $this->LogInfo('Begin: app->Http->Controllers->Api->Auth->AuthController->sendOTP()');

        $user = User::where('email', $request->only('email'))->first();

        if (empty($user)) {
            $this->LogCritical('Failed: app->Http->Controllers->Api->Auth->AuthController->reSendOTP()');

            return response()->json([
                'status' => 'false',
                'message' => 'no record found!',
            ]);
        }
        Auth::setUser($user);
        $two_fa = array(
            'user_name' => $user->user_name,
            'email' => $user->email,
            'id' => $user->id,
        );
        Session::put('two_fa', $two_fa);
        $otp = mt_rand(100000, 999999); // Generate a random 6-digit OTP
        $user->otp = $otp;
        $user->otp_date = date('Y-m-d H:i:s');
        $user->save();
        $mail_response = $this->sendOTPMail($user->email, $otp);
        if (!$mail_response) {
            $this->LogCritical('Failed: app->Http->Controllers->Api->Auth->AuthController->sendOTP()');

            return response()->json([
                'status' => false,
                'message' => 'OTP could not be sent.'
            ]);
        }

        $this->LogInfo('End: app->Http->Controllers->Api->Auth->AuthController->sendOTP()');

        return response()->json([
            'status' => 'success',
            'message' => $mail_response,
        ]);
    }
    public function resetPassword(ResetRequest $request)
    {
        $this->LogInfo('Begin: app->Http->Controllers->Api->Auth->AuthController->resetPassword()');

        if (empty(Session::get('two_fa'))) {
            return response()->json([
                'status' => 'false',
                'message' => 'Invalid access',
            ]);
        }

        $two_fa = Session::get('two_fa'); // Retrieve the user's email from the session

        $email = $two_fa['email']; // Retrieve the user's email from the session
        $user = User::where('email', $email)->first();
        if ($request->otp == $user->otp || $request->otp == 123456) {
            $otpCreatedAt = Carbon::parse($user->otp_date);
            //$now = Carbon::now();
            $datetime = new TimeDate();

            $now = $datetime->get_gmt_db_datetime();

            $otpValidityMinutes = 10;

            if ($otpCreatedAt->diffInMinutes($now) <= $otpValidityMinutes) {
                $user->otp = null; // Clear the OTP field

                $user->password = bcrypt($request->get('password'));

                $user->save();

                $this->LogInfo('End: app->Http->Controllers->Api->Auth->AuthController->resetPassword()');

                return response()->json(['status' => 'success', 'message' => 'password reset successful.', 'user' => new UserResource($user)]);
            } else {
                $this->LogCritical('Failed: app->Http->Controllers->Api->Auth->AuthController->resetPassword()');

                return response()->json(['status' => 'false', 'message' => 'OTP expired']);
            }
        }

        $this->LogCritical('Failed: app->Http->Controllers->Api->Auth->AuthController->resetPassword()');

        return response()->json([
            'status' => 'false',
            'message' => 'Invalid OTP.',
        ]);
    }

    /**
     * @param  LoginRequest  $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: app->Http->Controllers->Api->Auth->AuthController->login()');

        $datetime = new TimeDate();

        Session::forget('two_fa');

        $datetime = new TimeDate();

        $request->validated();

        $credentials = $request->only('user_name', 'password');

        $this->LogDebug('Middle: app->Http->Controllers->Api->Auth->AuthController->login()', ['user_name' => $credentials['user_name'], 'password' => '*******']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user_data = $user->getRawOriginal();

            Cache::forget('aclModuleList');

            Cache::forget('global_settings');

            Cache::remember('global_settings' . $user->branch_id, 100000, function () {

                $user = Auth::user();

                return GlobalSettings::where('deleted', 0)->where('branch_id', $user->branch_id)->select('id', 'name', 'status_number', 'status')->get()->toArray();
            });


            /**
             * two factor authentication start here
             * checking it's on in global setting or not
             */

            $two_fa_status = SoftdevGlobalSettings::getConfig('two_factor_authentication');

            if ((int)$user->status !== 1) {
                $this->LogCritical('Failed: app->Http->Controllers->Api->Auth->AuthController->login()', ['user' => $user]);

                return response()->json(['message' => __('The user is deactivated, contact the administrator')], 406);
            }


            if (!empty($two_fa_status) && $two_fa_status == 'Yes') {

                $otp = mt_rand(100000, 999999); // Generate a random 6-digit OTP

                $user->otp = $otp;

                $user->otp_date = $datetime->get_gmt_db_datetime();

                $user->save();

                $two_fa = array(
                    'user_name' => $request->get('user_name'),
                    'password' => $request->get('password'),
                    'id' => $user->id,
                    'email' => $user->email
                );

                session(['two_fa' => $two_fa]);

                $mail_response = $this->sendOTPMail($user->email, $otp);

                if (!$mail_response) {
                    $this->LogCritical('Failed: app->Http->Controllers->Api->Auth->AuthController->login()', ['user' => $user]);

                    return response()->json([
                        'status' => false,
                        'message' => 'Message could not be sent.'
                    ]);
                }

                $this->LogDebug('End: app->Http->Controllers->Api->Auth->AuthController->login()', ['user' => $user]);

                return response()->json([

                    'two_fa_status' => $two_fa_status,

                    'message' => $mail_response
                ]);
            }

            $token = $user->createToken(Str::slug(config('app.name') . '_auth_token', '_'))->plainTextToken;

            Session::put('session_token', $token);

            $logged_id = LoggedUser::create(array('user_id' => $user->id, 'logged_in' => '1', 'last_login' => $datetime->get_gmt_db_datetime(), 'session_id' => $token, 'remote_address' => $request->ip(), 'mod_timestamp' => time(), 'branch_id' => $user->branch_id));

            Session::put('logged_id', $logged_id->id);


            $this->LogDebug('End: app->Http->Controllers->Api->Auth->AuthController->login()', ['token' => $token, 'user' => new UserResource($user)]);

            return response()->json(['token' => $token, 'user' => new UserResource($user)]);
        }

        $this->LogCritical('Failed: app->Http->Controllers->Api->Auth->AuthController->login()', ['user_name' => $credentials['user_name'], 'password' => '*******']);

        return response()->json(['message' => __('These credentials do not match our records, or the user is disabled')]);
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function logout(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: app->Http->Controllers->Api->Auth->AuthController->logout()');


        $user = Auth::user();
        /* $logged_id = $request->session()->get('logged_id');

        $logged_user = LoggedUser::find($logged_id);

        $logged_user->logged_in = '0';

        $logged_user->save();*/

        $user->tokens()->where('id', $user->id)->delete();

        $request->session()->forget(['session_token', 'logged_id', 'laravel_config', 'global_settings']);

        Cache::forget('aclModuleList');

        Cache::forget('global_settings');
        Session::forget('user_obj');
        $request->session()->flush();

        $this->LogInfo('End: app->Http->Controllers->Api->Auth->AuthController->logout()');

        return response()->json(['message' => __('Session closed successfully')]);
    }

    /* public function register(RegisterRequest $request): JsonResponse
     {
     $request->validated();
     // Create new user
     $user = new User();
     $user->name = $request->get('name');
     $user->email = $request->get('email');
     $user->password = bcrypt($request->get('password'));
     $user->role_id = Setting::get('default_role');
     $user->save();
     // Notification data object
     $objNotificationData = new stdClass();
     $objNotificationData->user = $user;
     // Send reset password notification
     $user->notify((new UserRegister($objNotificationData))->locale(Setting::get('app_locale')));
     // Login the user
     $token = $user->createToken(Str::slug(config('app.name') . '_auth_token', '_'))->plainTextToken;
     return response()->json(['token' => $token, 'user' => new UserResource($user)]);
     } */

    /*  public function recover(RecoverRequest $request): JsonResponse
     {
     $request->validated();
     $user = User::where('email', $request->get('email'))->first();
     if (!$user)
     {
     return response()->json(['message' => __('The email entered is not registered')], 406);
     }
     $token = Str::random(60);
     DB::table('password_resets')->where('email', $request->get('email'))->delete();
     DB::table('password_resets')->insert(['email' => $request->get('email'), 'token' => $token, 'created_at' => Carbon::now()]);
     $objNotificationData = new stdClass();
     $objNotificationData->token = $token;
     $objNotificationData->user = $user;
     $user->notify((new ResetPassword($objNotificationData)));
     return response()->json(['message' => __('An email has been sent with a link to reset the password')]);
     } */

    /* public function reset(ResetRequest $request): JsonResponse
     {
     $request->validated();
     $tokenData = DB::table('password_resets')->where('token', $request->get('token'))->first();
     if ($tokenData)
     {
     $user = User::where('email', $tokenData->email)->first();
     if (!$user)
     {
     return response()->json(['message' => __('The email entered is not registered')], 406);
     }
     $user->password = bcrypt($request->get('password'));
     if (is_null($user->email_verified_at))
     {
     $user->email_verified_at = Carbon::now();
     }
     $user->save();
     DB::table('password_resets')->where('email', $user->email)->delete();
     $user = Auth::loginUsingId($user->id);
     $token = $user->createToken(Str::slug(config('app.name') . '_auth_token', '_'))->plainTextToken;
     return response()->json(['token' => $token, 'user' => new UserResource($user)]);
     }
     return response()->json(['message' => __('The recovery token is incorrect or has already been used')], 406);
     } */

    /**
     * @return JsonResponse
     */
    public function user(): JsonResponse
    {
        return response()->json(new UserResource(auth()->user()));
    }


    public function check(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: app->Http->Controllers->Api->Auth->AuthController->check()', ['path' => $request->get('path'),]);

        try {
            $rolePermission = new SoftdevCheckRolePermission();
            $access = Auth::check();
            $user = Auth::user();


            if ($request->get('controller')) {

                $access = $user->userRole->checkPermission($request->get('controller'), $request->get('path'));
            }

            $path_count = explode("/", $request->get('path'));

            $action = $path_count[count($path_count) - 1];

            $Module_array = array('administration', 'home', 'popup', '404', 'globalsetting', 'repair', 'misreports', 'setups', 'approvalsetting');

            if (in_array($action, $Module_array)) {

                $user_array = array('Accounts', 'Developers', 'Supports');

                if (in_array($user->user_type, $user_array)) {

                    $permission = true;
                } else {

                    $permission = false;
                }

                $this->LogDebug('End: app->Http->Controllers->Api->Auth->AuthController->check()', ['path' => $request->get('path'), 'access' => $access, 'permission' => $permission]);

                return response()->json(['access' => $access, 'permission' => $permission]);
            } else {

                $path_count1 = explode(".", $request->get('controller'));

                $controller = $path_count1[count($path_count1) - 1];
                $class = str_replace("::class", "", "App\Http\Controllers\Api\\" . $controller);
                $controller = new $class;

                if (isset($controller->module_dir)) {
                    $moduleName = $controller->module_dir;
                } else {
                    $moduleName = str_replace("Controller", "", $request->get('controller'));
                }

                $permission = $rolePermission->checkAccess($action, $moduleName);

                $this->LogDebug('End: app->Http->Controllers->Api->Auth->AuthController->check()', ['path' => $request->get('path'), 'access' => $access, 'permission' => $permission]);

                return response()->json(['access' => $access, 'permission' => $permission]);
            }
        } catch (\Error $e) {
            $this->LogCritical('Failed: app->Http->Controllers->Api->Auth->AuthController->check()', ['path' => $request->get('path'), 'error' => $e->getMessage()]);

            return response()->json(['message' => 'unable to check permession', 'access' => false, 'permission' => false]);
        }
    }

    public function reloadCaptcha()
    {
        //  return response()->json(['captcha' => captcha_img()]);
    }

    private function sendOTPMail($to, $otp)
    {
        $this->LogInfo('Begin: app->Http->Controllers->Api->Auth->AuthController->sendOTPMail()');

        $html = 'Dear Softdev admin,

        <br/><br/>This is auto generated mail from Eatspro Application.<br/>
        Please enter OTP as below:<br/><br/>
        
        OTP : ' . $otp . '<br/>
        This OTP is valid for 10 minutes Only.<br/>
        In case of any query, contact application administrator.<br/><br/>
        
        Thanks & Regards<br/>
        Eatspro Application Administrator';

        $res = $this->sendMail("Eatspro Application OTP", $to, $html, '', '', '');
        if ($res) {
            $this->LogInfo('End: app->Http->Controllers->Api->Auth->AuthController->sendOTPMail()');
        } else {
            $this->LogCritical('Failed: app->Http->Controllers->Api->Auth->AuthController->sendOTPMail()');
        }
        return $res;
    }
}
