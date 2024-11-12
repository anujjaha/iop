<?php 

namespace App\Http\Controllers\Backend\IpoAssignments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Repositories\IpoAssignments\EloquentIpoAssignmentsRepository;
use App\Models\IpoDetails\IpoDetails;

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
     * IpoAssignments Listing
     *
     * @return \Illuminate\View\View
     */
    public function filter(Request $request, $id)
    {
        $list = $this->repository->getFilterData($id);
        $item = IpoDetails::where('id', $id)->with(['assignments'])
            ->first();
        // dd($item);
        return view('backend.ipoassignments.filter')->with([
            'repository'    => $this->repository,
            'item'          => $item,
            'list'          => $list
        ]);
    }

    /**
     * IpoAssignments View
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request, $id = null)
    {
        $id = $request->has('id') ? $request->get('id') : null;
        //$clientList = $this->repository->getClients();
        $ipoList = $this->repository->getActiveIpos();
        $ipoOptions = [];

        foreach($ipoList as $ipo)
        {
            $ipoOptions[$ipo->id] = $ipo->ipo_name;
        }

        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository'    => $this->repository,
            'ipoOptions'    => $ipoOptions,
            'requestedIpo'  => $id
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
            ->addColumn('status', function ($item) {
                return getAssignmentLiveStatus($item->status);
            })
            ->addColumn('ipo_id', function ($item) {
                return '<a target="_blank" href="'. route('admin.ipoassignments.filter', $item->ipo->id) .'">'. $item->ipo->ipo_name . '</a>';
            })
            ->addColumn('ipo_amt', function ($item) {
                if($item->status == '1')
                {
                    return $item->share_qty * $item->ipo->price_band . '<br /><a href="javascript:void(0);" onclick="revokeIpo('.$item->id.')" class="btn btn-xs btn-primary"><i class="fa fa-trash"></i></a>'
                        . '&nbsp;&nbsp;<a href="javascript:void(0);" onclick="allotedIpo('.$item->id.')" class="btn btn-xs btn-primary"><i class="fa fa-check"></i></a>';    
                }

                if($item->status == 'Revoke')
                {
                    return 0;
                }

                return $item->share_qty * $item->ipo->price_band;
            })
            ->addColumn('actions', function ($item) {
                return $item->admin_action_buttons;
            })
            ->make(true);
    }

    public function getEligibleClients(Request $request)
    {
        $ipoId      = $request->get('ipoId');
        $isAll      = $request->get('all') ?? 0;
        $clientList = $this->repository->getEligibleClientList($ipoId, $isAll);
        $ipoDetails = IpoDetails::where('id', $ipoId)->first();

        return response()->json([
            'status'        => true,
            'clientList'    => $clientList,
            'ipoDetails'    => $ipoDetails
        ]);
    }

    public function getAssignedClientList(Request $request)
    {
        $ipoId      = $request->get('ipoId');
        $clientList = $this->repository->getAssignedClientList($ipoId);
        $ipoDetails = IpoDetails::where('id', $ipoId)->first();

        return response()->json([
            'status'        => true,
            'clientList'    => $clientList,
            'ipoDetails'    => $ipoDetails
        ]);
    }

    public function revokeIpo(Request $request)
    {
        $status = $this->repository->revokeAssignment($request->get('assignmentId'));

        return response()->json([
            'status' => true,
        ]);
    }

    public function allotedIpo(Request $request)
    {
        $status = $this->repository->allotedAssignment($request->get('assignmentId'));

        return response()->json([
            'status' => true,
        ]);
    }

    public function allotedList(Request $request)
    {
        $records = $this->repository->getAllotedList();

        return view('backend.ipoassignments.alloted-list')->with([
            'repository'    => $this->repository,
            'records'       => $records
        ]);       
    }

    public function settleIpo(Request $request)
    {
        $status = $this->repository->settleAssignment($request->all());

        return response()->json([
            'status' => true,
        ]);
    }

    public function assignClient(Request $request)
    {
        $status = $this->repository->create($request->all());

        return response()->json([
            'status' => true,
        ]);       
    }
}