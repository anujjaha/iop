<?php 

namespace App\Http\Controllers\Backend\Fees;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Repositories\Fees\EloquentFeesRepository;
use App\Models\ClientDetail\ClientDetail;

/**
 * Class AdminFeesController
 */
class AdminFeesController extends Controller
{
    /**
     * Fees Repository
     *
     * @var object
     */
    public $repository;

    /**
     * Create Success Message
     *
     * @var string
     */
    protected $createSuccessMessage = "Fees Created Successfully!";

    /**
     * Edit Success Message
     *
     * @var string
     */
    protected $editSuccessMessage = "Fees Edited Successfully!";

    /**
     * Delete Success Message
     *
     * @var string
     */
    protected $deleteSuccessMessage = "Fees Deleted Successfully";

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->repository = new EloquentFeesRepository;
    }

    /**
     * Fees Listing
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
     * Fees View
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $months = [
            'aug-2024' => 'Aug-2024',
            'sep-2024' => 'Sep-2024',
            'oct-2024' => 'Oct-2024',
            'nov-2024' => 'Nov-2024',
            'dec-2024' => 'Dec-2024',
        ];

        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository'    => $this->repository,
            'months'        => $months,
        ]);
    }

    /**
     * Fees Store
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * Fees Edit
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
     * Fees Show
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
     * Fees Update
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $status = $this->repository->update($id, $request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * Fees Destroy
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
                return $item->client->name ?? 'N/A';
            })
            ->addColumn('actions', function ($item) {
                return $item->admin_action_buttons;
            })
            ->make(true);
    }

    public function getClients(Request $request)
    {
        $clientList = $this->repository->getEligibleClientList($request->get('monthTitle'));

        return response()->json([
            'status'        => true,
            'clientList'    => $clientList
        ]);
    }

    /**
     * Pay Client
     * 
     * @param Request $request
     * @return jsonResponse
     */
    public function payClient(Request $request)
    {
        $input = $request->all();
        $isExists = $this->repository->model->where([
            'month_title' => $input['month_title'],
            'client_id'   => $input['client_id'],
        ])->first();

        if(!isset($isExists))
        {
            $status = $this->repository->create($request->all());

            if($status)
            {
                return response()->json([
                    'status' => true,
                ]);
            }
        }

        return response()->json([
            'status'    => false,
            'message'   => 'Already Paid'
        ]);
    }   
}