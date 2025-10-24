<?php 

namespace App\Http\Controllers\Backend\IpoDetails;

use DateTime;
use DateInterval;
use DatePeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Repositories\IpoDetails\EloquentIpoDetailsRepository;
use App\Repositories\IpoAssignments\EloquentIpoAssignmentsRepository;
use Illuminate\Support\Facades\Response;

/**
 * Class AdminIpoDetailsController
 */
class AdminIpoDetailsController extends Controller
{
    /**
     * IpoDetails Repository
     *
     * @var object
     */
    public $repository;

    /**
     * Create Success Message
     *
     * @var string
     */
    protected $createSuccessMessage = "IpoDetails Created Successfully!";

    /**
     * Edit Success Message
     *
     * @var string
     */
    protected $editSuccessMessage = "IpoDetails Edited Successfully!";

    /**
     * Delete Success Message
     *
     * @var string
     */
    protected $deleteSuccessMessage = "IpoDetails Deleted Successfully";

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->repository = new EloquentIpoDetailsRepository;
    }

    /**
     * IpoDetails Listing
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->repository->setAdmin(true)->getModuleView('listView'))->with([
            'repository' => $this->repository
        ]);
    }


    /**
     * IpoDetails View
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository' => $this->repository
        ]);
    }

    /**
     * IpoDetails Store
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * IpoDetails Edit
     *
     * @return \Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $item = $this->repository->findOrThrowException($id);

        return view($this->repository->setAdmin(true)->getModuleView('editView'))->with([
            'item'          => $item,
            'repository'    => $this->repository
        ]);
    }

    /**
     * IpoDetails Show
     *
     * @return \Illuminate\View\View
     */
    public function show($id, Request $request)
    {
        $item = $this->repository->model->where(['id' =>$id])
            ->with(['assignments', 'assignments.client'])
            ->first();

        $assignmentRepo = new EloquentIpoAssignmentsRepository();
        $clientList     = $assignmentRepo->getEligibleClientList($item->id);

        return view($this->repository->setAdmin(true)->getModuleView('showView'))->with([
            'item'          => $item,
            'repository'    => $this->repository,
            'clientList'    => $clientList
        ]);
    }


    /**
     * IpoDetails Update
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $status = $this->repository->update($id, $request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * IpoDetails Destroy
     *
     * @return \Illuminate\View\View
     */
    public function destroy($id)
    {
        $status = $this->repository->destroy($id);

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->deleteSuccessMessage);
    }

    /**
     * Get Table Data
     *
     * @return json|mixed
     */
    public function getTableData()
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['id', 'sort'])
            ->addColumn('ipo_name', function ($item) {
                return '<a href="' . route('admin.ipodetails.show', $item->id) . '">'.$item->ipo_name.'</a> <br />';  
            })
            ->addColumn('opening_date', function ($item) {
                $assignments = $item->assignments;

                $pl = $assignments->where('status',5)
                ->sum('profit_loss');
                
                $span = '';
                if($pl > 0)
                {
                    $span = '<span class="text-bold text-success">'.$pl.'</span>';
                }
                else
                {
                    $span = '<span class="text-danger">'.$pl.'</span>';
                }
                return $span;    
                
            })
            ->addColumn('closing_date', function ($item) {
                return $item->opening_date .'-'. $item->closing_date;
            })
            ->addColumn('actions', function ($item) {
                return $item->admin_action_buttons;
            })
            ->make(true);
    }

    /**
     * IpoDetails Show
     *
     * @return \Illuminate\View\View
     */
    public function showChart(Request $request)
    {
        $start  = new DateTime('2024-10-01');
        $end    = new DateTime();
        $end->modify('first day of next month');
        $interval = new DateInterval('P1M');
        $period = new DatePeriod($start, $interval, $end);
        $months = [];

        foreach ($period as $dt) {
            $months[] = $dt->format("M-Y");
        }
        $chartData = $this->repository->getChartData($months);
        $monthlyExpense = $this->repository->getMonthlyExpenses($months);
        

        // dd([
        //     'chartData' => $chartData,
        //     'monthlyExpense' => $monthlyExpense,
        //     'months'    => $months
        // ]);
        return view($this->repository->setAdmin(true)->getModuleView('chartView'))->with([
            'chartData'         => $chartData,
            'monthlyExpense'    => $monthlyExpense,
            'totalProfit'       => array_sum(array_values($chartData)),
            'totalExpense'      => array_sum(array_values($monthlyExpense)),
            'months'            => $months,
            'totalAccounts'     => 46
        ]);
    }

    public function uploadCsv(Request $request)
    {
        $ipoId = $request->get('ipoId');
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded.'], 400);
        }

        $file = $request->file('file');

        if ($file->getClientOriginalExtension() !== 'csv') {
            return response()->json(['error' => 'Invalid file type. Only CSV allowed.'], 422);
        }

        // Open the uploaded CSV file
        $handle = fopen($file->getRealPath(), 'r');
        $data = [];

        $csvH = [
            'sr',
            'name',
            'pan',
            'current',
            'remain',
            'applied'
        ];

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $data[] = array_combine($csvH, $row);
        }

        fclose($handle);

        // Now $data contains all rows as associative arrays
        // Example: Insert into DB
        $dataTostore = [];
        foreach ($data as $record) {
            $dataTostore[]  = $record;
        }

        $assignmentRepo = new EloquentIpoAssignmentsRepository();
        $assignmentRepo->bulkAssignment($ipoId, $dataTostore);


        die('Break');
    }

    public function downloadCsv(Request $request, $ipoId = null)
    {
        $data = $this->repository->prepareClientSheet($ipoId);
        // Filename
        $filename = "prepare.csv";

        // Create CSV string
        $csvData = $this->arrayToCsv($data);

        // Create response instance properly
        $response = Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);

        return $response;
    }

    // Helper function to convert array to CSV string
    private function arrayToCsv(array $data): string
    {
        $csv = fopen('php://temp', 'r+');
        foreach ($data as $row) {
            fputcsv($csv, $row);
        }
        rewind($csv);
        $csvData = stream_get_contents($csv);
        fclose($csv);
        return $csvData;
    }
}