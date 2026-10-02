<?php 

namespace App\Http\Controllers\Backend\AllFdList;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Repositories\AllFdList\EloquentAllFdListRepository;

/**
 * Class AdminAllFdListController
 */
class AdminAllFdListController extends Controller
{
    /**
     * AllFdList Repository
     *
     * @var object
     */
    public $repository;

    /**
     * Create Success Message
     *
     * @var string
     */
    protected $createSuccessMessage = "AllFdList Created Successfully!";

    /**
     * Edit Success Message
     *
     * @var string
     */
    protected $editSuccessMessage = "AllFdList Edited Successfully!";

    /**
     * Delete Success Message
     *
     * @var string
     */
    protected $deleteSuccessMessage = "AllFdList Deleted Successfully";

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->repository = new EloquentAllFdListRepository;
    }

    /**
     * AllFdList Listing
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
     * AllFdList View
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
     * AllFdList Store
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * AllFdList Edit
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
     * AllFdList Show
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
     * AllFdList Update
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $status = $this->repository->update($id, $request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * AllFdList Destroy
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
            ->addColumn('start_date', function ($item) {
                return date('d M Y',strtotime($item->start_date)) . ' - '.date('d M Y',strtotime($item->end_date)) ;
            })
            ->addColumn('actions', function ($item) {
                return $item->admin_action_buttons;
            })
            ->make(true);
    }
}