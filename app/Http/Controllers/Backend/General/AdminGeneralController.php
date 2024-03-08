<?php 

namespace App\Http\Controllers\Backend\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Repositories\General\EloquentGeneralRepository;

/**
 * Class AdminGeneralController
 */
class AdminGeneralController extends Controller
{
    /**
     * General Repository
     *
     * @var object
     */
    public $repository;

    /**
     * Create Success Message
     *
     * @var string
     */
    protected $createSuccessMessage = "General Created Successfully!";

    /**
     * Edit Success Message
     *
     * @var string
     */
    protected $editSuccessMessage = "General Edited Successfully!";

    /**
     * Delete Success Message
     *
     * @var string
     */
    protected $deleteSuccessMessage = "General Deleted Successfully";

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->repository = new EloquentGeneralRepository;
    }

    /**
     * General Listing
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
     * General View
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
     * General Store
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * General Edit
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
     * General Show
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
     * General Update
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $status = $this->repository->update($id, $request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * General Destroy
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
            ->editColumn('address', function($data) {
                $address = $data->address;

                if(!empty($data->gmap_qr))
                {
                    $address .= '<a targe="_blank" href="'. route('admin.general.qr-download', [$data->id, 'gmap_qr']) .'"><i class="fa fa-download float-right"></i></a><hr />';
                    $address .= '<br /><img  class="zoomItem" height="150" width="150" src="'.url(  '/general/'. $data->gmap_qr).'"/>';
                }

                return $address;
            })
            ->editColumn('primary_contact', function($data) {
                $contact = $data->primary_contact;

                if(!empty($data->phone_qr))
                {
                    $contact .= '<br /><img  class="zoomItem" height="150" width="150" src="'.url(  '/general/'. $data->phone_qr).'"/>';
                }

                return $contact;
                })
            ->editColumn('website', function($data) {
                $website = $data->website;

                if(!empty($data->web_qr))
                {
                    $website .= '<br /><img class="zoomItem" height="150" width="150" src="'.url(  '/general/'. $data->web_qr).'"/>';
                }

                return $website;
                })
            ->addColumn('actions', function ($item) {
                return $item->admin_action_buttons;
            })
            ->make(true);
    }

    public function downloadQrCode($id = null, $type = null)
    {
        $data = $this->repository->model->findOrfail($id);
        $filepath = null;
        switch($type)
        {
            case 'gmap_qr':
                $filepath = public_path('/general/'. $data->gmap_qr);
            break;

            default:
            break;
        }
            
        if(isset($filepath))
        {
           return response()->download($filepath, 'google_map_qr_code.png');    
        }
        
    }
}