<?php
namespace App\Modules\Schedulers;

use App\Modules\Schedulers\Resources\SchedulerResource;
use App\Common\Datetime\TimeDate;
class DetailView
{
    public function updateData($request, $scheduler)
    {
        try
        {
            $scheduler->LogDebug('Begin: Schedulers.DetailView->updateData()', ['params' => $request->all()]);

            $request->validated();
            $datetime = new TimeDate();
            $scheduler->name = $request->get('name');
            $scheduler->status = $request->get('status');
            $scheduler->job = $request->get('job');
            $scheduler->date_time_start = $datetime->get_gmt_db_datetime();
            $xtDays = array(0 => 'mon', 1 => 'tue', 2 => 'wed', 3 => 'thu', 4 => 'fri', 5 => 'sat', 6 => 'sun');
            if (!empty($request->get('all')) || (!empty($request->get('mon')) && !empty($request->get('tue')) && !empty($request->get('wed')) && !empty($request->get('thu')) && !empty($request->get('fri')) && !empty($request->get('sat')) && !empty($request->get('sun'))))
            {
                $day_of_week = '*';
            }
            else
            {
                $day_string = '';
                foreach ($xtDays as $k => $day)
                {
                    if (!empty($request->get($day)))
                    {
                        if ($day_string != '')
                        {
                            $day_string .= ',';
                        }
                        $day_string .= $k;
                    }
                }
                $day_of_week = $day_string;
            }
            if ($request->get('basic_period') == 'min')
            {
                $mins = '*/' . $request->get('basic_interval');
                $hours = '*';
            }
            else
            {
                $hours = '*/' . $request->get('basic_interval');
                $mins = '0';
            }
            $scheduler->job_interval = $mins . "::" . $hours . "::*::*::" . $day_of_week;
            if ($scheduler->save())
            {
                $scheduler->LogDebug('End: Schedulers.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $scheduler->id]);
                
                return response()->json(['message' => 'Record updated successfully'], 200);
            }
        }
        catch (\Throwable $e)
        {
            $scheduler->LogCritical('Failed: Schedulers.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $scheduler->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to update record'], 500);
        }
    }
}
