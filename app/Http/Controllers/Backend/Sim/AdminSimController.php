<?php 

namespace App\Http\Controllers\Backend\Sim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Repositories\Sim\EloquentSimRepository;

/**
 * Class AdminSimController
 */
class AdminSimController extends Controller
{
    /**
     * Sim Repository
     *
     * @var object
     */
    public $repository;

    /**
     * Create Success Message
     *
     * @var string
     */
    protected $createSuccessMessage = "Sim Created Successfully!";

    /**
     * Edit Success Message
     *
     * @var string
     */
    protected $editSuccessMessage = "Sim Edited Successfully!";

    /**
     * Delete Success Message
     *
     * @var string
     */
    protected $deleteSuccessMessage = "Sim Deleted Successfully";

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->repository = new EloquentSimRepository;
    }

    /**
     * Sim Listing
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
     * Sim Chart
     *
     * @return \Illuminate\View\View
     */
    public function chart()
    {
        return view($this->repository->setAdmin(true)->getModuleView('chartView'))->with([
            'repository' => $this->repository,
            'simData'    => $this->repository->getSimData(),
        ]);
    }

    /**
     * Sim View
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
     * Sim Store
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * Sim Edit
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
     * Sim Show
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
     * Sim Update
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $status = $this->repository->update($id, $request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * Sim Destroy
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
            ->addColumn('device_id', function ($item) {
                return $item->attachedDevice && $item->attachedDevice->id ? $item->attachedDevice->title : 'empty';
            })
            ->addColumn('plan_id', function ($item) {
                return $item->attachedPlan && $item->attachedPlan->id ? $item->attachedPlan->title . ' | ' . date('d M Y', strtotime($item->attachedPlan->expire_date)) : 'empty';
            })
            ->addColumn('actions', function ($item) {
                return $item->admin_action_buttons;
            })
            ->make(true);
    }
}