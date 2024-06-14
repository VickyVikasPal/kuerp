<?php
namespace App\Modules\Schedulers;

use App\Models\Scheduler;
use App\Modules\Schedulers\Resources\SchedulerResource;
use App\Common\Datetime\TimeDate;
use Auth;

class EditView
{
    public function addData($request)
    {
        $scheduler = new Scheduler();
        try
        {
            $scheduler->LogDebug('Begin: Schedulers.EditView->addData()', ['params' => $request->all()]);

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
            
            $scheduler->branch_id = Auth::User()->branch_id;

            if ($scheduler->save())
            {

                $scheduler->LogInfo('End: Schedulers.EditView->addData()', ['user_id' => $request->user()->id, 'record_id' => $scheduler->id]);

                return response()->json(['message' => 'Data saved correctly', 'scheduler' => new SchedulerResource($scheduler)]);
            }
        }
        catch (\Throwable $e)
        {
            $scheduler->LogCritical('Failed: Schedulers.EditView->addData()', ['user_id' => $request->user()->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to create Record'], 500);
        }

    }
}
