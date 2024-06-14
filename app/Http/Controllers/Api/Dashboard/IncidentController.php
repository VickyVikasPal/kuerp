<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Incidents\StoreRequest;
use App\Http\Requests\Dashboard\Incidents\UpdateRequest;
use App\Http\Resources\Component\ComponentResource;
use App\Http\Resources\Incident\IncidentEditResource;
use App\Http\Resources\Incident\IncidentListResource;
use App\Http\Resources\Incident\IncidentResource;
use App\Models\Component;
use App\Models\Incident;
use App\Models\IncidentHistory;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Str;
use Throwable;

class IncidentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $items = Incident::filter($request->all())->paginate((int) $request->get('perPage', 10));
        return response()->json([
            'items' => IncidentListResource::collection($items->items()),
            'pagination' => [
                'currentPage' => $items->currentPage(),
                'perPage' => $items->perPage(),
                'total' => $items->total(),
                'totalPages' => $items->lastPage()
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $request->validated();
        $incident = new Incident();
        $incident->uuid = Str::uuid();
        $incident->name = $request->get('incident')['name'];
        $incident->type = $request->get('incident')['type'];
        if ($incident->type === 1) {
            $incident->start_at = Carbon::now();
            $incident->impact = $request->get('incident')['impact'];
        } elseif ($incident->type === 2) {
            if (array_key_exists('start_at', $request->get('incident'))) {
                $incident->start_at = $request->get('incident')['start_at'];
            }
            if (array_key_exists('end_at', $request->get('incident'))) {
                $incident->end_at = $request->get('incident')['end_at'];
            }
        }
        if ($incident->save()) {
            $incident->components()->sync($request->get('incident')['components']);
            $incidentHistory = new IncidentHistory();
            $incidentHistory->incident_id = $incident->id;
            $incidentHistory->user_id = Auth::user()->id;
            $incidentHistory->message = $request->get('incident')['message'];
            if ($incident->type === 1) {
                $incidentHistory->status = $request->get('incident')['status'];
            } elseif ($incident->type === 2) {
                $incidentHistory->status = 0;
            }
            $incidentHistory->saveOrFail();
            foreach ($request->get('components') as $componentData) {
                if (in_array($componentData['id'], $request->get('incident')['components'], true)) {
                    $component = Component::findOrFail($componentData['id']);
                    $component->status = $componentData['status'];
                    $component->saveOrFail();
                }
            }
            return response()->json(['message' => 'Data saved correctly', 'incident' => new IncidentResource($incident)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  Incident  $incident
     * @return JsonResponse
     */
    public function show(Incident $incident): JsonResponse
    {
        return response()->json(new IncidentEditResource($incident));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  Incident  $incident
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(UpdateRequest $request, Incident $incident): JsonResponse
    {
        $request->validated();
        $incident->name = $request->get('incident')['name'];
        if ($incident->type === 1) {
            $incident->impact = $request->get('incident')['impact'];
            if ($request->get('incident_history')['status'] === 4 && $request->get('incident_history')['close_incident']) {
                $incident->end_at = Carbon::now();
            }
        } elseif ($incident->type === 2) {
            if (array_key_exists('start_at', $request->get('incident'))) {
                $incident->start_at = $request->get('incident')['start_at'];
            }
            if (array_key_exists('end_at', $request->get('incident'))) {
                $incident->end_at = $request->get('incident')['end_at'];
            }
        }
        if ($incident->save()) {
            $incident->components()->sync($request->get('incident')['components']);
            /** @var IncidentHistory $lastIncidentHistory */
            $lastIncidentHistory = $incident->incidentHistories->last();
            if (
                empty($request->get('incident_history')['message']) && !empty($request->get('incident_history')['status']) &&
                ((int) $request->get('incident_history')['status'] !== $lastIncidentHistory->status)
            ) {
                return response()->json(['message' => __('The :attribute field is required', ['attribute' => __('incident message')])], 500);
            }
            if (!empty($request->get('incident_history')['message'])) {
                $incidentHistory = new IncidentHistory();
                $incidentHistory->incident_id = $incident->id;
                $incidentHistory->user_id = Auth::user()->id;
                $incidentHistory->message = $request->get('incident_history')['message'];
                if ($incident->type === 1 && ((int) $request->get('incident_history')['status'] !== $lastIncidentHistory->status)) {
                    $incidentHistory->status = $request->get('incident_history')['status'];
                } else {
                    $incidentHistory->status = 0;
                }
                $incidentHistory->saveOrFail();
            }
            foreach ($request->get('components') as $componentData) {
                if (in_array($componentData['id'], $request->get('incident')['components'], true)) {
                    $component = Component::findOrFail($componentData['id']);
                    if ($incident->type === 1 && $request->get('incident_history')['status'] === 4 && $request->get('incident_history')['close_incident']) {
                        $component->status = 1;
                        $incident->end_at = Carbon::now();
                    } else {
                        $component->status = $componentData['status'];
                    }
                    $component->saveOrFail();
                }
            }
            return response()->json([
                'message' => 'Data saved correctly',
                'incident' => new IncidentEditResource($incident),
                'components' => ComponentResource::collection(Component::ordered()->get())
            ]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Incident  $incident
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Incident $incident): JsonResponse
    {
        $incident->incidentHistories()->delete();
        if ($incident->delete()) {
            return response()->json(['message' => 'Data deleted successfully']);
        }
        return response()->json(['message' => __('An error occurred while deleting data')], 500);
    }

    public function components(): JsonResponse
    {
        return response()->json(['items' => ComponentResource::collection(Component::ordered()->get())]);
    }
}
