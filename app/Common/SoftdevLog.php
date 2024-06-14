<?php
namespace App\Common;
use Log;
use Session;
use Illuminate\Support\Facades\Cache;
trait SoftdevLog
{
    public function LogInfo($message, array $context = [])
    {
        $logger = config('config');
        if ($logger['logger']['level'] == 'info') {
            Log::channel('custom')->info($message, $context);
        }
    }

    public function LogEmergency($message, array $context = [])
    {
        $logger = config('config');
        if ($logger['logger']['level'] == 'emergency' || $logger['logger']['level'] == 'info') {
            Log::channel('custom')->Emergency($message, $context);
        }
    }

    public function LogAlert($message, array $context = [])
    {
        $logger = config('config');
        if ($logger['logger']['level'] == 'alert') {
            Log::channel('custom')->alert($message, $context);
        }
    }

    public function LogCritical($message, array $context = [])
    {
        $logger = config('config');
        if ($logger['logger']['level'] == 'fatal' || $logger['logger']['level'] == 'critical' || $logger['logger']['level'] == 'info') {
            Log::channel('custom')->critical($message, $context);
        }
    }

    public function LogError($message, array $context = [])
    {
        $logger = config('config');
        if ($logger['logger']['level'] == 'error' || $logger['logger']['level'] == 'info') {
            Log::channel('custom')->error($message, $context);
        }
    }

    public function LogWarning($message, array $context = [])
    {
        $logger = config('config');
        if ($logger['logger']['level'] == 'warning' || $logger['logger']['level'] == 'info') {
            Log::channel('custom')->warning($message, $context);
        }
    }

    public function LogNotice($message, array $context = [])
    {
        $logger = config('config');
        if ($logger['logger']['level'] == 'notice' || $logger['logger']['level'] == 'info') {
            Log::channel('custom')->notice($message, $context);
        }
    }

    public function LogDebug($message, array $context = [])
    {
        $logger = config('config');
        if ($logger['logger']['level'] == 'debug' || $logger['logger']['level'] == 'info') {
            Log::channel('custom')->debug($message, $context);
        }
    }
}

?>