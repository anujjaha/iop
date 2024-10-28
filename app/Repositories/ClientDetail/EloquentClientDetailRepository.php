<?php 

namespace App\Repositories\ClientDetail;

/**
 * Class EloquentClientDetailRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\ClientDetail\ClientDetail;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentClientDetailRepository extends DbRepository
{
    /**
     * ClientDetail Model
     *
     * @var Object
     */
    public $model;

    /**
     * ClientDetail Title
     *
     * @var string
     */
    public $moduleTitle = 'ClientDetail';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'        => 'Id',
		'name'        => 'Name',
		'balance'        => 'Balance',
		'birthdate'        => 'Birthdate',
		'mobile'        => 'Mobile',
		'email'        => 'Email',
		'aadhar_no'        => 'Aadhar_no',
		'pan_no'        => 'Pan_no',
		'dmat_co_name'        => 'Dmat_co_name',
		'dmat_account'        => 'Dmat_account',
		'bank_name'        => 'Bank_name',
		'bank_account'        => 'Bank_account',
		'bank_branch'        => 'Bank_branch',
		'ifsc_code'        => 'Ifsc_code',
		'profit_loss'        => 'Profit_loss',
		'address'        => 'Address',
		'dmat_user_name'        => 'Dmat_user_name',
		'dmat_password'        => 'Dmat_password',
		'is_huf'        => 'Is_huf',
		'status'        => 'Status',
		'start_date'        => 'Start_date',
"actions"         => "Actions"
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
		'name' =>   [
                    'data'          => 'name',
                    'name'          => 'name',
                    'searchable'    => true,
                    'sortable'      => true
                ],
        'balance' =>   [
                    'data'          => 'balance',
                    'name'          => 'balance',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'birthdate' =>   [
                    'data'          => 'birthdate',
                    'name'          => 'birthdate',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'mobile' =>   [
                    'data'          => 'mobile',
                    'name'          => 'mobile',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'email' =>   [
                    'data'          => 'email',
                    'name'          => 'email',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'aadhar_no' =>   [
                    'data'          => 'aadhar_no',
                    'name'          => 'aadhar_no',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'pan_no' =>   [
                    'data'          => 'pan_no',
                    'name'          => 'pan_no',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'dmat_co_name' =>   [
                    'data'          => 'dmat_co_name',
                    'name'          => 'dmat_co_name',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'dmat_account' =>   [
                    'data'          => 'dmat_account',
                    'name'          => 'dmat_account',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'bank_name' =>   [
                    'data'          => 'bank_name',
                    'name'          => 'bank_name',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'bank_account' =>   [
                    'data'          => 'bank_account',
                    'name'          => 'bank_account',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'bank_branch' =>   [
                    'data'          => 'bank_branch',
                    'name'          => 'bank_branch',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'ifsc_code' =>   [
                    'data'          => 'ifsc_code',
                    'name'          => 'ifsc_code',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		
		'profit_loss' =>   [
                    'data'          => 'profit_loss',
                    'name'          => 'profit_loss',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'address' =>   [
                    'data'          => 'address',
                    'name'          => 'address',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'dmat_user_name' =>   [
                    'data'          => 'dmat_user_name',
                    'name'          => 'dmat_user_name',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'dmat_password' =>   [
                    'data'          => 'dmat_password',
                    'name'          => 'dmat_password',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'is_huf' =>   [
                    'data'          => 'is_huf',
                    'name'          => 'is_huf',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'status' =>   [
                    'data'          => 'status',
                    'name'          => 'status',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'start_date' =>   [
                    'data'          => 'start_date',
                    'name'          => 'start_date',
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
        'listRoute'     => 'clientdetail.index',
        'createRoute'   => 'clientdetail.create',
        'storeRoute'    => 'clientdetail.store',
        'editRoute'     => 'clientdetail.edit',
        'updateRoute'   => 'clientdetail.update',
        'deleteRoute'   => 'clientdetail.destroy',
        'dataRoute'     => 'clientdetail.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'clientdetail.index',
        'createView'    => 'clientdetail.create',
        'editView'      => 'clientdetail.edit',
        'showView'      => 'clientdetail.show',
        'deleteView'    => 'clientdetail.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new ClientDetail;
    }

    /**
     * Create ClientDetail
     *
     * @param array $input
     * @return mixed
     */
    public function create($input)
    {
        $input = $this->prepareInputData($input, true);
        $model = $this->model->create($input);

        if($model)
        {
            return $model;
        }

        return false;
    }

    /**
     * Update ClientDetail
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

            return $model->update($input);
        }

        return false;
    }

    /**
     * Destroy ClientDetail
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
        return $this->model->select($this->getTableFields())->get();
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
}