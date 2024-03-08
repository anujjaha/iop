<?php 

namespace App\Repositories\Content;

/**
 * Class EloquentContentRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use File;
use App\Models\Content\Content;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;
use App\Models\Visit\Visit;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class EloquentContentRepository extends DbRepository
{
    /**
     * Content Model
     *
     * @var Object
     */
    public $model;

    /**
     * Content Title
     *
     * @var string
     */
    public $moduleTitle = 'Content';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'                  => 'Id',
		'slug'                => 'Slug',
		'company_name'        => 'Company Name',
		'owner_1'             => 'Primary Owner',
		'owner_2'             => 'Secondary Owner',
		'contact_primary'     => 'Primary Contact',
		'contact_secondary'   => 'Other Contact',
		'email'               => 'Email',
		'website'             => 'Website',
		'address'             => 'Address',
		'city'                => 'City',
		'state'               => 'State',
		'pincode'             => 'Pincode',
        "actions"             => "Actions"
    ];

    /**
     * Table Columns
     *
     * @var array
     */
    public $tableColumns = [
        'id' =>   [
                    'data'          => 'id',
                    'name'          => 'id',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'slug' =>   [
                    'data'          => 'slug',
                    'name'          => 'slug',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'company_name' =>   [
                    'data'          => 'company_name',
                    'name'          => 'company_name',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'owner_1' =>   [
                    'data'          => 'owner_1',
                    'name'          => 'owner_1',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'owner_2' =>   [
                    'data'          => 'owner_2',
                    'name'          => 'owner_2',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'contact_primary' =>   [
                    'data'          => 'contact_primary',
                    'name'          => 'contact_primary',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'contact_secondary' =>   [
                    'data'          => 'contact_secondary',
                    'name'          => 'contact_secondary',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'email' =>   [
                    'data'          => 'email',
                    'name'          => 'email',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'website' =>   [
                    'data'          => 'website',
                    'name'          => 'website',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'address' =>   [
                    'data'          => 'address',
                    'name'          => 'address',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'city' =>   [
                    'data'          => 'city',
                    'name'          => 'city',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'state' =>   [
                    'data'          => 'state',
                    'name'          => 'state',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'pincode' =>   [
                    'data'          => 'pincode',
                    'name'          => 'pincode',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'actions' => [
                'data'          => 'actions',
                'name'          => 'actions',
                'searchable'    => false,
                'sortable'      => false
            ]
    ];

    /**
     * Is Admin
     *
     * @var boolean
     */
    protected $isAdmin = false;

    /**
     * Admin Route Prefix
     *
     * @var string
     */
    public $adminRoutePrefix = 'admin';

    /**
     * Client Route Prefix
     *
     * @var string
     */
    public $clientRoutePrefix = 'frontend';

    /**
     * Admin View Prefix
     *
     * @var string
     */
    public $adminViewPrefix = 'backend';

    /**
     * Client View Prefix
     *
     * @var string
     */
    public $clientViewPrefix = 'frontend';

    /**
     * Module Routes
     *
     * @var array
     */
    public $moduleRoutes = [
        'listRoute'     => 'content.index',
        'createRoute'   => 'content.create',
        'storeRoute'    => 'content.store',
        'editRoute'     => 'content.edit',
        'updateRoute'   => 'content.update',
        'deleteRoute'   => 'content.destroy',
        'dataRoute'     => 'content.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'content.index',
        'createView'    => 'content.create',
        'editView'      => 'content.edit',
        'deleteView'    => 'content.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new Content;
    }

    /**
     * Create Content
     *
     * @param array $input
     * @return mixed
     */
    public function create($request)
    {
        $input = $this->prepareInputData($request->all(), true);
        $model = $this->model->create($input);

        if($model)
        {
            $logo   = $this->uploadLogo($model, $request);
            $jpg    = $this->uploadJPGFile($model, $request);
            $pdf    = $this->uploadPDFFile($model, $request);
            $qr_1   = $this->vcardQrCode($model);
            $qr_2   = $this->googleMapQrCode($model);
            $slug   = strtolower($this->generateSlug($model));
            $createdBy = $this->newUserSignUp($model);
            
            $model->logo = $logo;
            $model->image = $jpg;
            $model->file_pdf = $pdf;
            $model->qr_1 = $qr_1;
            $model->qr_2 = $qr_2;
            $model->slug = $slug;
            $model->created_by = $createdBy->id;
            $model->save();

            $qr_3 = $this->myQrCode($model);


            if($qr_3)
            {
                $model->qr_3 = $qr_3;
                $model->save();
            }
            return $model;
        }

        return false;
    }

    protected function uploadLogo($model = null, $input = null)
    {
        if($input->file('logo')) 
        {
            $file = $input->file('logo');
            $fileName = md5($model->id) . '.' .$file->getClientOriginalExtension();
            $destinationPath = 'media/logo/' . $model->id;
            if($file->move($destinationPath, $fileName)) 
            {
                return $fileName;    
            }
        }

        return null;
    }

    /**
     * Upload JPG
     *
     */
    protected function uploadJPGFile($model = null, $input = null)
    {
        if($input->file('image')) 
        {
            $file = $input->file('image');
            $fileName = md5($model->id) . '.' .$file->getClientOriginalExtension();
            $destinationPath = 'media/images/' . $model->id;
            if($file->move($destinationPath, $fileName)) 
            {
                return $fileName;
            }
        }

        return null;
    }

    /**
     * Upload PDF
     *
     */
    protected function uploadPDFFile($model = null, $input = null)
    {
        if($input->file('file_pdf')) 
        {
            $file = $input->file('file_pdf');
            $fileName = md5($model->id) . '.' .$file->getClientOriginalExtension();
            $destinationPath = 'media/pdf/' . $model->id;
            if($file->move($destinationPath, $fileName))
            {
                return $fileName;
            }
        }

        return null;
    }

    /**
     * Update Content
     *
     * @param int $id
     * @param array $input
     * @return bool|int|mixed
     */
    public function update($id, $input)
    {
        $model = $this->model->find($id);

        if($model)
        {
            $input = $this->prepareInputData($input);
            unset($input['created_at']);
            return $model->update($input);
        }

        return false;
    }

    /**
     * Destroy Content
     *
     * @param int $id
     * @return mixed
     * @throws GeneralException
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);

        if($model)
        {
            return $model->delete();
        }

        return  false;
    }

    /**
     * Get All
     *
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getAll($orderBy = 'id', $sort = 'asc')
    {
        return $this->model->orderBy($orderBy, $sort)->get();
    }

    /**
     * Get by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id = null)
    {
        if($id)
        {
            return $this->model->find($id);
        }

        return false;
    }

    /**
     * Get Table Fields
     *
     * @return array
     */
    public function getTableFields()
    {
        return [
            $this->model->getTable().'.*'
        ];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model->select($this->getTableFields())->orderBy('id','desc')->get();
    }

    /**
     * Set Admin
     *
     * @param boolean $isAdmin [description]
     */
    public function setAdmin($isAdmin = false)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Prepare Input Data
     *
     * @param array $input
     * @param bool $isCreate
     * @return array
     */
    public function prepareInputData($input = array(), $isCreate = false)
    {
        if($isCreate)
        {
            $input = array_merge($input, ['user_id' => access()->user()->id]);
        }

        return $input;
    }

    /**
     * Get Table Headers
     *
     * @return string
     */
    public function getTableHeaders()
    {
        if($this->isAdmin)
        {
            return json_encode($this->setTableStructure($this->tableHeaders));
        }

        $clientHeaders = $this->tableHeaders;

        unset($clientHeaders['username']);

        return json_encode($this->setTableStructure($clientHeaders));
    }

    /**
     * Get Table Columns
     *
     * @return string
     */
    public function getTableColumns()
    {
        if($this->isAdmin)
        {
            return json_encode($this->setTableStructure($this->tableColumns));
        }

        $clientColumns = $this->tableColumns;

        unset($clientColumns['username']);

        return json_encode($this->setTableStructure($clientColumns));
    }

    public function vcardQrCode($model = null)
    {
        if(isset($model) && isset($model->id))
        {
            // Personal Information
            $owner = explode(" ", $model->owner_1);
            $firstName = $owner[0] ?? '';
            $lastName = $owner[1] ?? '';
            $title = '';
            $email = $model->email ?? '';
            
            // Addresses
            $homeAddress = [
                'type'      => 'work',
                'pref'      => true,
                'street'    => $model->address,
                'city'      => $model->city,
                'state'     => $model->state,
                'country'   => 'INDIA',
                'zip'       => $model->pincode
            ];
            
            $addresses = [$homeAddress];
            
            // Phones
            $workPhone = [
                'type'      => 'work',
                'number'    => $model->contact_primary,
                'cellPhone' => true
            ];
            $fileName = md5($model->id) . '_1.png';
            $phones = [$workPhone];

            $this->checkAndCreateMediaPath(public_path() . '/media/qr_1/' . $model->id);
            \QRCode::vCard($firstName, $lastName, $title, $email, $addresses, $phones)
                    ->setErrorCorrectionLevel('H')
                    ->setSize(2)
                    ->setOutfile(public_path() . '/media/qr_1/' . $model->id .'/'. $fileName)
                    ->setMargin(6)
                    ->png();
            return $fileName;    
        }
        
        return null;
    }

    public function googleMapQrCode($model = null)
    {
        if(isset($model) && isset($model->id) && isset($model->google_map) && !empty($model->google_map))
        {
            $fileName = md5($model->id) . '_1.png';
            $this->checkAndCreateMediaPath(public_path() . '/media/qr_2/' . $model->id);
            \QRCode::url($model->google_map)
                    ->setErrorCorrectionLevel('H')
                    ->setSize(2)
                    ->setOutfile(public_path() . '/media/qr_2/' . $model->id .'/'. $fileName)
                    ->setMargin(6)
                    ->png();
            return $fileName;    
        }
        
        return null;
    }

    public function myQrCode($model = null)
    {
        if(isset($model) && isset($model->id) && isset($model->slug) && !empty($model->slug))
        {
            $fileName = md5($model->id) . '.png';
            $this->checkAndCreateMediaPath(public_path() . '/media/qr_3/');
            \QRCode::url(url('/i/' . $model->slug) )
                    ->setErrorCorrectionLevel('H')
                    ->setSize(2)
                    ->setOutfile(public_path() . '/media/qr_3/' . $fileName)
                    ->setMargin(6)
                    ->png();
            return $fileName;    
        }
        
        return null;
    }

    protected function generateSlug($model = null)
    {
        if(isset($model) && isset($model->id))
        {
            $slug = $model->company_name;
            $slug = str_replace(" ", '-', $slug);

            $isExists = $this->model->where('slug', $slug)->first();

            if(!isset($isExists))
            {
                return $slug;
            }

            $slug = $slug . '-' . explode(" ", $model->company_name)[0];

            $isExists = $this->model->where('slug', $slug)->first();

            if(!isset($isExists))
            {
                return $slug;
            }

            $slug = $slug . '-' .substr($model->contact_primary, -3);

            $isExists = $this->model->where('slug', $slug)->first();

            if(!isset($isExists))
            {
                return $slug;
            }

            return $slug . '-' . rand(111, 999);
        }
    }

    public function getBySlug($slug = null)
    {
        if(isset($slug))
        {
            $content = $this->model->where('slug', $slug)->first();
            return $content ?? null;
        }

        return null;
    }

    public function checkAndCreateMediaPath($path = null)
    {
        if(isset($path))
        {
            File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);    
        }
        
        return true;
    }

    protected function newUserSignUp($model = null)
    {
        if(isset($model->id))
        {
            return User::create([
                'name'      => $model->owner_1,
                'email'     => $model->email ?? $model->id . '_email@yopmail.com',
                'password'  => Hash::make($model->contact_primary),
            ]);
        }

        return null;
    }

    public function logVisit($content = null)
    {
        if(isset($content))
        {
            $visit = new Visit();

            return $visit->create([
                'content_id'    => $content->id,
                'user_id'       => access()->user()->id ??  null,
                'actionType'    => 1,
                'ip'            => request()->ip(),
                'user_agent'    => request()->header('User-Agent')
            ]);
        }
    }

    public function contentCounter($content = null)
    {
        if(isset($content->id))
        {
            $this->logVisit($content);
            return Visit::where('content_id', $content->id)->count();
        }

        return 0;
    }
}