<?php 

namespace App\Repositories\Sim;

/**
 * Class EloquentSimRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\Sim\Sim;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentSimRepository extends DbRepository
{
    /**
     * Sim Model
     *
     * @var Object
     */
    public $model;

    /**
     * Sim Title
     *
     * @var string
     */
    public $moduleTitle = 'Sim';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'        => 'Id',
		'device_id'        => 'Device',
		'plan_id'        => 'Plan',
		'company'        => 'Company',
		'mobile_number'        => 'Number',
		'cost'        => 'Cost',
		'purchase_date'        => 'Purchased',
		'status'        => 'Status',
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
		'device_id' =>   [
                    'data'          => 'device_id',
                    'name'          => 'device_id',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'plan_id' =>   [
                    'data'          => 'plan_id',
                    'name'          => 'plan_id',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'company' =>   [
                    'data'          => 'company',
                    'name'          => 'company',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'mobile_number' =>   [
                    'data'          => 'mobile_number',
                    'name'          => 'mobile_number',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'cost' =>   [
                    'data'          => 'cost',
                    'name'          => 'cost',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'purchase_date' =>   [
                    'data'          => 'purchase_date',
                    'name'          => 'purchase_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'status' =>   [
                    'data'          => 'status',
                    'name'          => 'status',
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
        'listRoute'     => 'sim.index',
        'createRoute'   => 'sim.create',
        'storeRoute'    => 'sim.store',
        'editRoute'     => 'sim.edit',
        'updateRoute'   => 'sim.update',
        'deleteRoute'   => 'sim.destroy',
        'dataRoute'     => 'sim.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'sim.index',
        'createView'    => 'sim.create',
        'editView'      => 'sim.edit',
        'deleteView'    => 'sim.destroy',
        'chartView'    => 'sim.chart',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new Sim;
    }

    /**
     * Create Sim
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
     * Update Sim
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
     * Destroy Sim
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

        if(!empty($input['purchase_date']))
        {
            $input['purchase_date'] = date('Y-m-d', strtotime($input['purchase_date']));
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

    public function getSimData()
    {
        $sims = $this->model->get();
        $output = [];

        foreach ($sims as $sim)
        {
            $output[] = [
                'number'        => $sim->mobile_number,
                'status'        => "Active",
                'lastRecharge'  => $sim->attachedPlan->recharge_date,
                'plan'          => $sim->attachedPlan->title,
                'expiry'        => $sim->attachedPlan->expire_date,
                'device'        => $sim->attachedDevice->title,
            ];
        }

        return $output;
    }
}