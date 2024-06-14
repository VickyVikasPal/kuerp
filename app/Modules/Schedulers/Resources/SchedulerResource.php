<?php
namespace App\Modules\Schedulers\Resources;

use App\Models\Scheduler;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Common\Datetime\TimeDate;
use JsonException;

class SchedulerResource extends JsonResource
{

    var $job;
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     * @throws JsonException
     */
    public function toArray($request)
    {
        if (!empty($this->job_interval)) {
            $exInterval = explode("::", $this->job_interval);
        }
        else {
            $exInterval = array('*', '*', '*', '*', '*');
        }
        $xtDays = array(0 => 'mon', 1 => 'tue', 2 => 'wed', 3 => 'thu', 4 => 'fri', 5 => 'sat', 6 => 'sun');
       
        if ($exInterval[4] == '*') {
            $all ='all';
            $mon ='mon';
            $tue ='tue';
            $wed ='wed';
            $thu ='thu';
            $fri ='fri';
            $sat ='sat';
            $sun ='sun';
        }
        elseif (strpos($exInterval[4], ',')) {
            $exDays = explode(',', trim($exInterval[4]));
            foreach ($exDays as $k => $days) {
                if (strpos($days, '-')) {
                    $exDaysRange = explode('-', $days);
                    for ($i = $exDaysRange[0]; $i <= $exDaysRange[1]; $i++) {
                        ${$xtDays[$days]} = $xtDays[$days];
                    }
                }
                else {
                    ${$xtDays[$days]} = $xtDays[$days];
                }
            }
        }
        elseif (strpos($exInterval[4], '-')) {
            $exDaysRange = explode('-', $exInterval[4]);
            for ($i = $exDaysRange[0]; $i <= $exDaysRange[1]; $i++) {
                ${$xtDays[$i]} = $xtDays[$i];
            }
        }
        else {
            ${$xtDays[$exInterval[4]]} = $xtDays[$exInterval[4]];
        }

        for($i=1; $i<=30; $i++) {
            $ints[$i] = $i;
        }

        if($exInterval[0] == '*' && $exInterval[1] == '*') {
            $basic_interval = 1;
            $basic_period = 'min';
        // hours
        } elseif(strpos($exInterval[1], '*/') !== false && $exInterval[0] == '0') {
            // we have a "BASIC" type of hour setting
            $exHours = explode('/', $exInterval[1]);
            $basic_interval = $exHours[1];
            $basic_period = 'hour';
        // Minutes
        } elseif(strpos($exInterval[0], '*/') !== false && $exInterval[1] == '*' ) {
            // we have a "BASIC" type of min setting
            $exMins = explode('/', $exInterval[0]);
            $basic_interval = $exMins[1];
            $basic_period = 'min';
        // we've got an advanced time setting
        } else {
            $basic_interval = 10;
            $basic_period = 'hour';
        }
        if(strstr($this->job, 'url::')) {
            $job_url = str_replace('url::','', $this->job);
        } else {
            $job_url = 'http://';
        }
        //print_r($sun);die;
        $datetime = new TimeDate();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'job' => $this->job,
            'status' => $this->status,
            'basic_interval' => $basic_interval??'',
            'basic_period' => $basic_period??'',
            'all' => $all??'',
            'mon' => $mon??'',
            'tue' => $tue??'',
            'wed' => $wed??'',
            'thu' => $thu??'',
            'fri' => $fri??'',
            'sat' => $sat??'',
            'sun' => $sun??'',
            'job_url' => $job_url??'',
            'date_time_start' => $datetime->to_display_date_time($this->date_time_start),
            'date_entered' => $datetime->to_display_date_time($this->date_entered),
            'date_modified' => $datetime->to_display_date_time($this->date_modified),
        ];
    }
}
