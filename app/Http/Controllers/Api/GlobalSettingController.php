<?php
/*********************************************************************************
 * This program is developed by Softdev Infotech Pvt. Ltd.
* Copyright Softdev Infotech Pvt. Ltd. 2010
*********************************************************************************/

namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Models\Sequence;
use App\Models\GlobalSettings;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\Administration\Requests\StoreRequest;
use App\Modules\Administration\Requests\GlobalSettingsRequest;
use App\Modules\Administration\Resources\GlobalSettingsResource;
use App\Modules\Administration\Global_Settings;
use Session;
use Cache;
use Artisan;
use App\Common\GlobalSettings as G_Settings; 

class GlobalSettingController extends SoftdevController
{
    public function __construct()
    {
        $this->LogDebug('GlobalSettingController initialized');
        
        $this->middleware('auth:sanctum');
        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return JsonResponse
     * @throws JsonException
     */

    /* public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: GlobalSettings.controller->index()');

        $sequence = new ListView();
        
        return response()->json($sequence->getDatas($request));
    } */

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    
    public function getGlobal(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: GlobalSettings.controller->getGlobal()');

        $global_set = new Global_Settings();

        return response()->json($global_set->getGlobalSettings($request));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    /* public function update(UpdateRequest $request, GlobalSettings $globalsettings): JsonResponse
    {
        $this->LogInfo('Begin: GlobalSettings.controller->update()');

       // $request->validated();
       $detail = new DetailView();
       $message = $detail->updateData($request, $globalsettings);

       if ($message['message'] =='success') {
        return response()->json(['message' => 'Data updated correctly', 'GlobalSetting' => new GlobalSettingsResource($globalsettings)]);
    }
    return response()->json(['message' => __('An error occurred while saving data')], 500);
    } */

    public function updateGlobal(Request $request)
    {
        $this->LogInfo('Begin: GlobalSettings.controller->updateGlobal()');

        $global_set = new Global_Settings();

        $message = $global_set->updateGlobalSettings($request);
        
        if ($message['message'] =='success') {

            return response()->json(['message' => 'Update Successfully!.....']);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

/*     public function remove(Request $request)
    {
        $this->LogInfo('Begin: GlobalSettings.controller->remove()');

        $product=GlobalSettings::find($request->get('delete_id'));
        $product->deleted = '1';
        $product->save();

        return response()->json(['message' => 'Data deleted successfully']);
    }
 */
    public function resetGlobal(Request $request)
    {
        $this->LogInfo('Begin: GlobalSettings.controller->resetGlobal()');

        $logged_id = Cache::get('logged_id');

        $user_token = Cache::get('session_token');
        
        if($request->reset == true)
        {
            Artisan::call('cache:clear');
            
            G_Settings::getAllConfigs($user_token, $logged_id);
        }
        
        $this->LogDebug('End: GlobalSettings.controllers->resetGlobal()');

        return response()->json(['message' => 'Reset Successfully!.....']);
    }
}


?>