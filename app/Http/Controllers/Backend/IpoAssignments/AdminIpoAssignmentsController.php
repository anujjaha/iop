<?php 

namespace App\Http\Controllers\Backend\IpoAssignments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Repositories\IpoAssignments\EloquentIpoAssignmentsRepository;

/**
 * Class AdminIpoAssignmentsController
 */
class AdminIpoAssignmentsController extends Controller
{
    /**
     * IpoAssignments Repository
     *
     * @var object
     */
    public $repository;

    /**
     * Create Success Message
     *
     * @var string
     */
    protected $createSuccessMessage = "IpoAssignments Created Successfully!";

    /**
     * Edit Success Message
     *
     * @var string
     */
    protected $editSuccessMessage = "IpoAssignments Edited Successfully!";

    /**
     * Delete Success Message
     *
     * @var string
     */
    protected $deleteSuccessMessage = "IpoAssignments Deleted Successfully";

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->repository = new EloquentIpoAssignmentsRepository;
    }

    /**
     * IpoAssignments Listing
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
     * IpoAssignments View
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        //$clientList = $this->repository->getClients();
        $ipoList = $this->repository->getActiveIpos();
        $ipoOptions = [];

        foreach($ipoList as $ipo)
        {
            $ipoOptions[$ipo->id] = $ipo->ipo_name;
        }

        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository'    => $this->repository,
            'ipoOptions'    => $ipoOptions
        ]);
    }

    /**
     * IpoAssignments Store
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * IpoAssignments Edit
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
     * IpoAssignments Show
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
     * IpoAssignments Update
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $status = $this->repository->update($id, $request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * IpoAssignments Destroy
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
                return $item->client->name;
            })
            ->addColumn('ipo_id', function ($item) {
                return $item->ipo->ipo_name;
            })
            ->addColumn('ipo_amt', function ($item) {
                if($item->status == 'Applied')
                {
                    return $item->ipo->block_amt . '<a href="javascript:void(0);" onclick="revokeIpo('.$item->id.')" class="btn btn-sm btn-primary">Revoke</a>';    
                }

                if($item->status == 'Revoke')
                {
                    return 0;
                }

                return $item->ipo->block_amt;
            })
            ->addColumn('actions', function ($item) {
                return $item->admin_action_buttons;
            })
            ->make(true);
    }

    public function getEligibleClients(Request $request)
    {
        $ipoId      = $request->get('ipoId');
        $clientList = $this->repository->getEligibleClientList($ipoId);

        return response()->json([
            'status'        => true,
            'clientList'    => $clientList
        ]);
    }

    public function revokeIpo(Request $request)
    {
        $status = $this->repository->revokeAssignment($request->get('assignmentId'));

        return response()->json([
            'status' => true,
        ]);
    }
}