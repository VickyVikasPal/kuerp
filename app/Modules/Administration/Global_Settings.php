<?php
namespace App\Modules\Administration;

use Illuminate\Http\Request;

use App\Common\GlobalSettings;

use App\Common\SoftdevLog;

class Global_Settings
{
    use SoftdevLog;

    public function getGlobalSettings($request)
    {
        $this->LogInfo('Begin: app->Modules->Administration->Global_Settings->getGlobalSettings()');

        try
        {
            //getGlobalSettings
            //getConfig
            $data = array(
                'no_allow_user_login' => GlobalSettings::getConfig('no_allow_user_login'),
                'two_factor_authentication' => GlobalSettings::getConfig('two_factor_authentication'),
                'login_with_captcha' => GlobalSettings::getConfig('login_with_captcha'),
            );

            $this->LogDebug('End: app->Modules->Administration->Global_Settings->getGlobalSettings()');

            return $data;
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: app->Modules->Administration->Global_Settings->getGlobalSettings()', ['error' => $e->getMessage()]);
        }
    }

    public function updateGlobalSettings($request)
    {
        try
        {
            $this->LogInfo('Begin: app->Modules->Administration->Global_Settings->updateGlobalSettings()');

            foreach ($request->all() as $key => $value)
            {
                //echo "Key : ". $key ." |=====| Value : ". $value;
                GlobalSettings::setConfig($key, "status", $value);
            }

            $array = array('message' => 'success');

            $this->LogDebug('End: app->Modules->Administration->Global_Settings->updateGlobalSettings()');
            
            return $array;
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: app->Modules->Administration->Global_Settings->updateGlobalSettings()', ['error' => $e->getMessage()]);
        }
    }

}