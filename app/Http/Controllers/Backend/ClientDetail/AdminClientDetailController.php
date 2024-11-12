<?php 

namespace App\Http\Controllers\Backend\ClientDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Repositories\ClientDetail\EloquentClientDetailRepository;

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

        // dd($item->stockList);
        return view($this->repository->setAdmin(true)->getModuleView('showView'))->with([
            'item'          => $item,
            'eligibleIpos'  => $eligibleIpos,
            'repository'    => $this->repository,
            'fees'          => $fees
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
            ->addColumn('actions', function ($item) {
                return $item->admin_action_buttons;
            })
            ->addColumn('name', function ($item) {
                return '<a target="_blank" href="'.route('admin.clientdetail.show', $item->id).'">'.$item->name.'</a>';
            })
            ->make(true);
    }
}