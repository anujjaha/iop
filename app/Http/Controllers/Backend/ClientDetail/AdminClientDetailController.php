<?php 

namespace App\Http\Controllers\Backend\ClientDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Repositories\ClientDetail\EloquentClientDetailRepository;
use App\Repositories\StockDetails\EloquentStockDetailsRepository;
use Illuminate\Support\Facades\Response;

/**
 * Class AdminClientDetailController
 */
class AdminClientDetailController extends Controller
{
    /**
     * ClientDetail Repository
     *
     * @var object
     */
    public $repository;

    /**
     * Create Success Message
     *
     * @var string
     */
    protected $createSuccessMessage = "ClientDetail Created Successfully!";

    /**
     * Edit Success Message
     *
     * @var string
     */
    protected $editSuccessMessage = "ClientDetail Edited Successfully!";

    /**
     * Delete Success Message
     *
     * @var string
     */
    protected $deleteSuccessMessage = "ClientDetail Deleted Successfully";

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->repository = new EloquentClientDetailRepository;
    }

    /**
     * ClientDetail Listing
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
     * ClientDetail View
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
     * ClientDetail Store
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * ClientDetail Edit
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
     * ClientDetail Show
     *
     * @return \Illuminate\View\View
     */
    public function show($id, Request $request)
    {
        $item           = $this->repository->model->with(['assignedIpos', 'assignedIpos.ipo', 'transactions', 'monthlyFees', 'stockList'])->where('id',$id)->first();
        $eligibleIpos   = $this->repository->getPendingIpos($item->id);
        $fees           = $this->repository->getFeeTransactions($item->id);
        $documents      = $this->repository->getMyDocuments($item->id);
        $stockRepo      = new EloquentStockDetailsRepository();
        $allStocks      = $stockRepo->getAllStocks();
        $myStocks       = $this->repository->getMyStocks($item->id);
        $stockTransactions = $this->repository->getMyStockTransactions($item->id);

        return view($this->repository->setAdmin(true)->getModuleView('showView'))->with([
            'item'          => $item,
            'eligibleIpos'  => $eligibleIpos,
            'repository'    => $this->repository,
            'fees'          => $fees,
            'documents'     => $documents,
            'allStocks'     => $allStocks,
            'myStocks'      => $myStocks,
            'stockTransactions' => $stockTransactions
        ]);
    }


    /**
     * ClientDetail Update
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $status = $this->repository->update($id, $request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * ClientDetail Destroy
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
            ->addColumn('balance', function ($item) {
                $html = '';
                if($item->balance > 0)
                {
                    $html = '<span style="color: green;">'. $item->balance .'</span>';
                }
                else
                {
                    $html = '<span style="color: red;">'. $item->balance .'</span>';
                }

                $html .= '<p><a href="javascript:void(0);" class="btn btn-xs btn-primary add-balance" onclick="addBalance('.$item->id.', `'. $item->name .'`)">Add</a></p>';

                return $html;
            })
            ->addColumn('bank_account', function ($item) {
                $html = $item->bank_account;
                    

                $isFreeSelected = $item->is_free == 1 ? 'checked="checked"' :'';
                $isPaidSelected = $item->is_free == 0 ? 'checked="checked"' :'';
                $html .= '<br/>
                    <label>
                        <input type="radio" name="paid'.$item->id.'" class="paid-radio"
                            data-id="'.$item->id.'" value="0" '.$isPaidSelected.'>
                        Paid
                    </label>
                    <label>
                        <input type="radio" name="paid'.$item->id.'" class="paid-radio"
                            data-id="'.$item->id.'" value="1" '.$isFreeSelected.'>
                        Free
                    </label>
                ';

                return $html;
            })
            ->addColumn('profit_loss', function ($item) {
                $assignedIpos = $item->assignedIpos->where('status', 5);

                if($assignedIpos)
                {
                    return $assignedIpos->sum('final_net_pl');
                }
                return 0;
            })
            ->addColumn('actions', function ($item) {
                return $item->admin_action_buttons;
            })
            ->addColumn('name', function ($item) {
                return '<a target="_blank" href="'.route('admin.clientdetail.show', $item->id).'">'.$item->name.'</a>';

            })
            ->addColumn('email', function ($item) {
                $rSelected = $item->investory_category == 1 ? 'checked="checked"' :'';
                $sSelected = $item->investory_category == 2 ? 'checked="checked"' :'';
                return $item->email.'<br/>
                    <label>
                        <input type="radio" name="category'.$item->id.'" class="category-radio"
                            data-id="'.$item->id.'" value="1" '.$rSelected.'>
                        Retail
                    </label>
                    <label>
                        <input type="radio" name="category'.$item->id.'" class="category-radio"
                            data-id="'.$item->id.'" value="2" '.$sSelected.'>
                        HNI
                    </label>
                ';
            })
            ->make(true);
    }

    /**
     * ClientDetail Show
     *
     * @return \Illuminate\View\View
     */
    public function investoryCategory(Request $request)
    {
        $status = $this->repository->updateCategory($request->all());
        if($status)
        {
            return response()->json([
                'status' => true,
            ]);       
        }

        return response()->json([
            'status' => false,
        ]);
    }

    /**
     * ClientDetail Show
     *
     * @return \Illuminate\View\View
     */
    public function investoryPayType(Request $request)
    {
        $status = $this->repository->updatePaidType($request->all());
        if($status)
        {
            return response()->json([
                'status' => true,
            ]);       
        }

        return response()->json([
            'status' => false,
        ]);
    }

    /**
     * Reset Balance
     *
     * @return \Illuminate\View\View
     */
    public function resetBalance(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded.'], 400);
        }

        $file = $request->file('file');

        if ($file->getClientOriginalExtension() !== 'csv') {
            return response()->json(['error' => 'Invalid file type. Only CSV allowed.'], 422);
        }

        $status = $this->repository->resetBalance($file);
        
        if($status)
        {
            return response()->json([
                'status' => true,
            ]);       
        }

        return response()->json([
            'status' => false,
        ]);
    }

    /**
     * Download Balance
     *
     * @return \Illuminate\View\View
     */
    public function downloadBalance(Request $request)
    {
        $data = $this->repository->downloadClients();
        // Filename
        $filename = "clients.csv";

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

