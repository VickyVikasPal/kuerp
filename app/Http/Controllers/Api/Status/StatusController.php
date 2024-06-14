<?php

namespace App\Http\Controllers\Api\Status;

use App\Http\Controllers\Controller;
use App\Http\Resources\Component\ComponentStatusResource;
use App\Http\Resources\Incident\IncidentWithHistoriesResource;
use App\Models\Component;
use App\Models\Incident;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class StatusController extends Controller
{
    public function resume(): JsonResponse
    {
        $status = 0;
        if (Component::count() !== 0) {
            if (Component::where('status', 5)->count() === Component::count()) {
                $status = 5;
            } elseif (Component::where('status', 5)->count() > 0) {
                $status = 4;
            } elseif (Component::where('status', 4)->count() > 0) {
                $status = 3;
            } elseif (Component::where('status', 3)->count() > 0) {
                $status = 2;
            } elseif (Component::where('status', 2)->count() > 0) {
                $status = 1;
            }
        }

        $incidents = Incident::where('end_at', '>=', Carbon::now())->orWhereNull('end_at')->get();
        return response()->json([
            'status' => $status,
            'incidents' => IncidentWithHistoriesResource::collection($incidents)
        ]);
    }

    public function components(): JsonResponse
    {
        $components = Component::ordered()
            ->whereDate('start_at', '<=', Carbon::now()->toDateString())
            ->orWhereNull('start_at')
            ->get();
        return response()->json(['items' => ComponentStatusResource::collection($components)]);
    }

    public function history(): JsonResponse
    {
        $start_date = Carbon::now();
        $end_date = Carbon::now()->subDays(15);
        $dates = [];
        for ($date = $start_date->copy(); $date->greaterThan($end_date); $date->subDay()) {
            $dateString = $date->toDateString();
            $incidents = Incident::whereDate('start_at', '=', $dateString)
                ->whereDate('end_at', '<=', Carbon::now())
                ->orderByDesc('created_at')
                ->get();
            $dates[] = [
                'date' => $dateString,
                'incidents' => IncidentWithHistoriesResource::collection($incidents)
            ];
        }
        return response()->json($dates);
    }

    public function incident($uuid): JsonResponse
    {
        return response()->json(new IncidentWithHistoriesResource(Incident::whereUuid($uuid)->firstOrFail()));
    }
}
