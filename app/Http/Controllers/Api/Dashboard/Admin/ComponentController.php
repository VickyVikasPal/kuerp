<?php

namespace App\Http\Controllers\Api\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Components\StoreRequest;
use App\Http\Requests\Dashboard\Admin\Components\UpdateRequest;
use App\Http\Resources\Component\ComponentResource;
use App\Models\Component;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['items' => ComponentResource::collection(Component::ordered()->get())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $request->validated();
        $component = new Component();
        $component->name = $request->get('name');
        $component->status = 1;
        $component->description = $request->get('description');
        $component->display_uptime = $request->get('display_uptime');
        if ($request->get('start_at')) {
            $component->start_at = Carbon::create($request->get('start_at'));
        }
        if ($component->save()) {
            return response()->json(['message' => 'Data saved correctly', 'component' => new ComponentResource($component)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  Component  $component
     * @return JsonResponse
     */
    public function show(Component $component): JsonResponse
    {
        return response()->json(new ComponentResource($component));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  Component  $component
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Component $component): JsonResponse
    {
        $request->validated();
        $component->name = $request->get('name');
        $component->status = $request->get('status');
        $component->description = $request->get('description');
        $component->display_uptime = $request->get('display_uptime');
        if ($request->get('start_at')) {
            $component->start_at = Carbon::create($request->get('start_at'));
        }
        if ($component->save()) {
            return response()->json(['message' => 'Data updated correctly', 'component' => new ComponentResource($component)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Component  $component
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Component $component): JsonResponse
    {
        if ($component->delete()) {
            return response()->json(['message' => 'Data deleted successfully']);
        }
        return response()->json(['message' => __('An error occurred while deleting data')], 500);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function order(Request $request): JsonResponse
    {
        if ($request->has('components')) {
            $order = [];
            $components = $request->get('components');
            foreach ($components as $component) {
                $order[] = $component['id'];
            }
            Component::setNewOrder($order);
            return response()->json(['message' => 'Data updated correctly']);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }
}
