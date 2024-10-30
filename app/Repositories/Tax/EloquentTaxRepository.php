<?php 

namespace App\Repositories\Tax;

/**
 * Class EloquentTaxRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\Tax\Tax;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentTaxRepository extends DbRepository
{
    /**
     * Tax Model
     *
     * @var Object
     */
    public $model;

    /**
     * Tax Title
     *
     * @var string
     */
    public $moduleTitle = 'Tax';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        		'id'        => 'Id',
		'client_id'        => 'Client_id',
		'ipo_id'        => 'Ipo_id',
		'total_amount'        => 'Total_amount',
		'profit_amount'        => 'Profit_amount',
		'tax_amount'        => 'Tax_amount',
        'net_profit'        => 'Net Profit',
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
		'ipo_id' =>   [
                    'data'          => 'ipo_id',
                    'name'          => 'ipo_id',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'total_amount' =>   [
                    'data'          => 'total_amount',
                    'name'          => 'total_amount',
                    'searchable'    => true,
                    'sortable'      => true
                ],
        'profit_amount' =>   [
                    'data'          => 'profit_amount',
                    'name'          => 'profit_amount',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'tax_amount' =>   [
                    'data'          => 'tax_amount',
                    'name'          => 'tax_amount',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'net_profit' =>   [
                    'data'          => 'net_profit',
                    'name'          => 'net_profit',
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
        'listRoute'     => 'tax.index',
        'createRoute'   => 'tax.create',
        'storeRoute'    => 'tax.store',
        'editRoute'     => 'tax.edit',
        'updateRoute'   => 'tax.update',
        'deleteRoute'   => 'tax.destroy',
        'dataRoute'     => 'tax.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'tax.index',
        'createView'    => 'tax.create',
        'editView'      => 'tax.edit',
        'deleteView'    => 'tax.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new Tax;
    }

    /**
     * Create Tax
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
     * Update Tax
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
     * Destroy Tax
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
        return $this->model->orderBy($orderBy, $sort)
            ->with(['ipo', 'client'])
            ->get();
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

        $input['tax_amount'] = ($input['total_amount'] / 100 ) * get20TaxRate();
        $input['net_profit'] = $input['profit_amount'] - $input['tax_amount'];

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