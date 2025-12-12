<?php 

namespace App\Repositories\Simplan;

/**
 * Class EloquentSimplanRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\Simplan\Simplan;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;
use App\Models\Sim\Sim;

class EloquentSimplanRepository extends DbRepository
{
    /**
     * Simplan Model
     *
     * @var Object
     */
    public $model;

    /**
     * Simplan Title
     *
     * @var string
     */
    public $moduleTitle = 'Simplan';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        		'id'        => 'Id',
		'sim_id'        => 'Sim_id',
		'title'        => 'Title',
		'cost'        => 'Cost',
		'recharge_date'        => 'Recharge_date',
		'expire_date'        => 'Expire_date',
		'current_plan'        => 'Current_plan',
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
		'sim_id' =>   [
                    'data'          => 'sim_id',
                    'name'          => 'sim_id',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'title' =>   [
                    'data'          => 'title',
                    'name'          => 'title',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'cost' =>   [
                    'data'          => 'cost',
                    'name'          => 'cost',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'recharge_date' =>   [
                    'data'          => 'recharge_date',
                    'name'          => 'recharge_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'expire_date' =>   [
                    'data'          => 'expire_date',
                    'name'          => 'expire_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'current_plan' =>   [
                    'data'          => 'current_plan',
                    'name'          => 'current_plan',
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
        'listRoute'     => 'simplan.index',
        'createRoute'   => 'simplan.create',
        'storeRoute'    => 'simplan.store',
        'editRoute'     => 'simplan.edit',
        'updateRoute'   => 'simplan.update',
        'deleteRoute'   => 'simplan.destroy',
        'dataRoute'     => 'simplan.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'simplan.index',
        'createView'    => 'simplan.create',
        'editView'      => 'simplan.edit',
        'deleteView'    => 'simplan.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new Simplan;
    }

    /**
     * Create Simplan
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
     * Update Simplan
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
     * Destroy Simplan
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

    public function addNew($input = [])
    {
        $simCard = Sim::where('id', $input['simId'])->first();
        if($simCard)
        {
            $input = [
                'sim_id'        => $input['simId'],
                'title'         => $input['planTitle'],
                'cost'          => $input['planCost'],
                'recharge_date' => date('Y-m-d', strtotime($input['planDate'])),
                'expire_date'   => date('Y-m-d', strtotime($input['planEDate'])),
            ];
            $simPlan = Simplan::create($input);

            $simCard->plan_id = $simPlan->id;
            return $simCard->save();
        }

        return false;
    }
}