<?php 

namespace App\Http\Controllers\Backend\Stock;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Repositories\Stock\EloquentStockRepository;
use App\Repositories\ClientDetail\EloquentClientDetailRepository;

/**
 * Class AdminStockController
 */
class AdminStockController extends Controller
{
    /**
     * Stock Repository
     *
     * @var object
     */
    public $repository;

    /**
     * Create Success Message
     *
     * @var string
     */
    protected $createSuccessMessage = "Stock Created Successfully!";

    /**
     * Edit Success Message
     *
     * @var string
     */
    protected $editSuccessMessage = "Stock Edited Successfully!";

    /**
     * Delete Success Message
     *
     * @var string
     */
    protected $deleteSuccessMessage = "Stock Deleted Successfully";

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->repository = new EloquentStockRepository;
    }

    /**
     * Stock Listing
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
     * Stock View
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $clientRepo = new EloquentClientDetailRepository();
        $clientList = $clientRepo->getArrayList();

        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository'    => $this->repository,
            'clientList'    => $clientList
        ]);
    }

    /**
     * Stock Store
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * Stock Edit
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
     * Stock Show
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
     * Stock Update
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $status = $this->repository->update($id, $request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * Stock Destroy
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
            ->addColumn('client_id', function ($item) {
                return $item->client->getFullName();
            })
            ->addColumn('external_link', function ($item) {
                $profit = $item->qty * $item->cmp;
                if($profit > 0)
                {
                    return '<a target="_blank" href="'.$item->external_link.'" class="btn btn-sm btn-success">'.$profit.'</a>';
                }
                else
                {
                    return '<a target="_blank" href="'.$item->external_link.'" class="btn btn-sm btn-warning">'.$profit.'</a>';
                }
            })
            ->addColumn('actions', function ($item) {
                return $item->admin_action_buttons;
            })
            ->make(true);
    }

    public function sell(Request $request)
    {
        $status = $this->repository->sellStock($request->all());

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