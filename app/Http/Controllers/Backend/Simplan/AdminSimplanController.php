<?php 

namespace App\Http\Controllers\Backend\Simplan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Repositories\Simplan\EloquentSimplanRepository;

/**
 * Class AdminSimplanController
 */
class AdminSimplanController extends Controller
{
    /**
     * Simplan Repository
     *
     * @var object
     */
    public $repository;

    /**
     * Create Success Message
     *
     * @var string
     */
    protected $createSuccessMessage = "Simplan Created Successfully!";

    /**
     * Edit Success Message
     *
     * @var string
     */
    protected $editSuccessMessage = "Simplan Edited Successfully!";

    /**
     * Delete Success Message
     *
     * @var string
     */
    protected $deleteSuccessMessage = "Simplan Deleted Successfully";

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->repository = new EloquentSimplanRepository;
    }

    /**
     * Simplan Listing
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
     * Simplan View
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
     * Simplan Store
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * Simplan Edit
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
     * Simplan Show
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
     * Simplan Update
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $status = $this->repository->update($id, $request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * Simplan Destroy
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
            ->addColumn('actions', function ($item) {
                return $item->admin_action_buttons;
            })
            ->make(true);
    }

    /**
     * Simplan Destroy
     *
     * @return \Illuminate\View\View
     */
    public function addNew(Request $request)
    {
        $status = $this->repository->addNew($request->all());

        if($status)
        {
            return response()->json([
                'status' => true
            ]);
        }
        
        return response()->json([
            'status' => false
        ]);
    }
}