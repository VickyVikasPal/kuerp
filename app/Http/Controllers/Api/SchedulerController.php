<?php
namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\Schedulers\Requests\StoreRequest;
use App\Modules\Schedulers\Requests\UpdateRequest;
use App\Modules\Schedulers\Resources\SchedulerResource;
use App\Models\Scheduler;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\Schedulers\ListView;
use App\Modules\Schedulers\DetailView;
use App\Modules\Schedulers\EditView;
use Illuminate\Support\Facades\DB;


class SchedulerController extends SoftdevController
{

    public $module_dir = 'Scheduler'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = ''; // it should be same as app->Modules->{YourModuleName}

    private $job_string = array(
    '1' => 'sendReport',
    '2' => 'updateReport',
    '3' => 'refreshJobs',
    '4' => 'sendSms',
    '5' => 'testReport',
    );

    public $export_field = array(
    'name' => 'Scheduler Name',
    'scheduler_code' => 'Scheduler Code',
    );
    public function __construct()
    {
        $this->LogDebug('SchedulerController initialized');

        $table_name = new Scheduler();

        $this->table_name = $table_name->table;

        $this->middleware('auth:sanctum');

        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);
    }

    public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: Schedulers.controller->index()');

        $listview = new ListView();

        return $listview->getDatas($request);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: Schedulers.controller->store()');

        $edit = new EditView();

        return $edit->addData($request);
    }

    public function show(Scheduler $scheduler): JsonResponse
    {
        $this->LogInfo('Begin: Schedulers.controller->show()');
        try
        {
            $this->LogDebug('End: Schedulers.controller->show()', ['record_id' => $scheduler->id]);

            return response()->json(new SchedulerResource($scheduler));
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: Schedulers.controller->show()', ['record_id' => $scheduler->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }

    public function update(UpdateRequest $request, Scheduler $scheduler): JsonResponse
    {
        $this->LogInfo('Begin: Schedulers.controller->update()');

        $detail = new DetailView();
        return $detail->updateData($request, $scheduler);
    }

    public function export($request)
    {
        $this->LogInfo('Begin: Schedulers.controller->export()');

        $user_list = new ListView();
        return $user_list->export($request);
    }

    public function getStatus(Request $request)
    {
        $this->LogInfo('Begin: Schedulers.controller->getStatus()');

        try
        {
            $record = $request->all();

            $record_id = '';
            if (isset($record) && isset($record['params']['search']))
            {
                $record_id = $record['params']['search'][0]['scheduler_id'];
            }

            $sort = $record['params']['sort'];
            $page = $record['params']['page'];
            $limit = $record['params']['perPage'];


            $items = DB::table('schedulers_times')->where('scheduler_id', $record_id)->orderBy($sort['column'], $sort['order'])->paginate((int)$request->get('perPage', 10));

            $array = [
                'items' => $items, //SchedulerResource::collection($items->items()),
                'pagination' => [
                    'currentPage' => $items->currentPage(),
                    'perPage' => $items->perPage(),
                    'total' => $items->total(),
                    'totalPages' => $items->lastPage()
                ]
            ];

            $this->LogDebug('End: Schedulers.ListView->export()', ['count' => count($items)]);

            return response()->json($array);
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: Schedulers.controller->getStatus()');

            return response()->json(['message' => 'Failed to retrieve records'], 500);
        }
    }
}
