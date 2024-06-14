<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\Incident;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;

class StatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * @return JsonResponse
     */
    public function count(): JsonResponse
    {
        return response()->json([
            'open_incidents' => Incident::whereType(1)->where(static function ($query) {
                /** @var Builder $query */
                $query->whereDate('end_at', '>', Carbon::now())->orWhereNull('end_at');
            })->count(),
            'incidents' => Incident::whereType(1)->count(),
            'scheduled_maintenance' => Incident::whereType(2)
                ->whereDate('start_at', '>=', Carbon::now())
                ->where(static function ($query) {
                    /** @var Builder $query */
                    $query->whereDate('end_at', '>', Carbon::now())->orWhereNull('end_at');
                })->count(),
            'components' => Component::count()
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function openClosedIncidents(): JsonResponse
    {
        $openedIncidents = [];
        $closedIncidents = [];
        $scheduledMaintenances = [];
        $month = 1;
        while ($month <= 12) {
            $openedIncidents[] = Incident::whereType(1)->whereMonth('start_at', '=', $month)->count();
            $closedIncidents[] = Incident::whereType(1)->whereMonth('end_at', '=', $month)->count();
            $scheduledMaintenances[] = Incident::whereType(2)->whereMonth('start_at', '=', $month)->count();
            $month++;
        }
        return response()->json([
            'opened_incidents' => $openedIncidents,
            'closed_incidents' => $closedIncidents,
            'scheduled_maintenances' => $scheduledMaintenances
        ]);
    }
}
