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
use App\Models\IpoDetails\IpoDetails;
use App\Models\IpoAssignments\IpoAssignments;
use App\Models\Fees\Fees;

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
        'id'              => 'Id',
		'name'            => 'Name',
		'balance'         => 'Balance',
		'mobile'          => 'Mobile',
		'email'           => 'Email',
		'aadhar_no'       => 'Aadhar_no',
		'pan_no'          => 'Pan_no',
		'profit_loss'        => 'Profit_loss',
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
		'profit_loss' =>   [
                    'data'          => 'profit_loss',
                    'name'          => 'profit_loss',
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
        'showRoute'     => 'clientdetail.show',
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

    public function getPendingIpos($clientId = null)
    {
        $assignedIpoIds = IpoAssignments::where('client_id', $clientId)->pluck('ipo_id');
        
        return IpoDetails::whereDate('closing_date', '>= ', date('Y-m-d'))
            ->whereNotIn('id', $assignedIpoIds)
            ->get();
    }

    public function getFeeTransactions($id)
    {
        return Fees::where('client_id', $id)->get();
    }
}