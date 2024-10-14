<?php 

namespace App\Http\Controllers\Backend\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Repositories\Transactions\EloquentTransactionsRepository;
use App\Models\ClientDetail\ClientDetail;

/**
 * Class AdminTransactionsController
 */
class AdminTransactionsController extends Controller
{
    /**
     * Transactions Repository
     *
     * @var object
     */
    public $repository;

    /**
     * Create Success Message
     *
     * @var string
     */
    protected $createSuccessMessage = "Transactions Created Successfully!";

    /**
     * Edit Success Message
     *
     * @var string
     */
    protected $editSuccessMessage = "Transactions Edited Successfully!";

    /**
     * Delete Success Message
     *
     * @var string
     */
    protected $deleteSuccessMessage = "Transactions Deleted Successfully";

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->repository = new EloquentTransactionsRepository;
    }

    /**
     * Transactions Listing
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
     * Transactions View
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $clients = ClientDetail::get();
        $clientOptions = [];
        foreach($clients as $client)
        {
            $clientOptions[$client->id] = $client->name;
        }

        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository'    => $this->repository,
            'clientOptions' => $clientOptions
        ]);
    }

    /**
     * Transactions Store
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * Transactions Edit
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
     * Transactions Show
     *
     * @return \Illuminate\View\View
     */
    public function show($id, Request $request)
    {
        $item = $this->repository->findOrThrowException($id);

        return view($this->repository->setAdmin(true)->getModuleView('editView'))->with([
            'item'          => $item,
            'repository'    => $this->repository
        ]);
    }


    /**
     * Transactions Update
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $status = $this->repository->update($id, $request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * Transactions Destroy
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
            ->addColumn('ipo_id', function ($item) {
                return $item->ipo ? $item->ipo->ipo_name : '';
            })
            ->addColumn('client_id', function ($item) {
                return $item->client ? $item->client->name : '';
            })
            ->addColumn('debit', function ($item) {
                if($item->debit)
                {
                    return $item->amount;
                }
                return '';
            })
            ->addColumn('credit', function ($item) {
                if($item->credit)
                {
                    return $item->amount;
                }
                return '';
            })
            ->addColumn('amount', function ($item) {
                if($item->balance > 0)
                {
                    return '<span style="color: green;">'. $item->balance .'</span>';
                }
                return '<span style="color: red;">'. $item->balance .'</span>';
            })
            ->addColumn('actions', function ($item) {
                return $item->admin_action_buttons;
            })
            ->make(true);
    }

    public function addBalance(Request $request)
    {
        $input = $request->all();
        $status = $this->repository->create($request->all());

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
}