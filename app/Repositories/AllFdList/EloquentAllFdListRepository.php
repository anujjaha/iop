<?php 

namespace App\Repositories\AllFdList;

/**
 * Class EloquentAllFdListRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\AllFdList\AllFdList;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentAllFdListRepository extends DbRepository
{
    /**
     * AllFdList Model
     *
     * @var Object
     */
    public $model;

    /**
     * AllFdList Title
     *
     * @var string
     */
    public $moduleTitle = 'AllFdList';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'        => 'Id',
		'client_id'        => 'Client',
		'payout_type'        => 'Payout',
		'title'        => 'Title',
		'amount'        => 'Amount',
		'start_date'        => 'Date',
		'rate_of_int'        => 'Int Rate',
		'expected_monthly_int'        => 'Monthly',
		'notes'        => 'Notes',
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
		'client_id' =>   [
                    'data'          => 'client_id',
                    'name'          => 'client_id',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'payout_type' =>   [
                    'data'          => 'payout_type',
                    'name'          => 'payout_type',
                    'searchable'    => true,
                    'sortable'      => true
                ],
        'title' =>   [
                    'data'          => 'title',
                    'name'          => 'title',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'amount' =>   [
                    'data'          => 'amount',
                    'name'          => 'amount',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'start_date' =>   [
                    'data'          => 'start_date',
                    'name'          => 'start_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'rate_of_int' =>   [
                    'data'          => 'rate_of_int',
                    'name'          => 'rate_of_int',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'expected_monthly_int' =>   [
                    'data'          => 'expected_monthly_int',
                    'name'          => 'expected_monthly_int',
                    'searchable'    => true,
                    'sortable'      => true
                ],
        'notes' =>   [
                    'data'          => 'notes',
                    'name'          => 'notes',
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
        'listRoute'     => 'allfdlist.index',
        'createRoute'   => 'allfdlist.create',
        'storeRoute'    => 'allfdlist.store',
        'editRoute'     => 'allfdlist.edit',
        'updateRoute'   => 'allfdlist.update',
        'deleteRoute'   => 'allfdlist.destroy',
        'dataRoute'     => 'allfdlist.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'allfdlist.index',
        'createView'    => 'allfdlist.create',
        'editView'      => 'allfdlist.edit',
        'deleteView'    => 'allfdlist.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new AllFdList;
    }

    /**
     * Create AllFdList
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
     * Update AllFdList
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
     * Destroy AllFdList
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
        return $this->model->select($this->getTableFields())
            ->with(['client'])
            ->get();
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