<?php 

namespace App\Repositories\StockTransaction;

/**
 * Class EloquentStockTransactionRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\StockTransaction\StockTransaction;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentStockTransactionRepository extends DbRepository
{
    /**
     * StockTransaction Model
     *
     * @var Object
     */
    public $model;

    /**
     * StockTransaction Title
     *
     * @var string
     */
    public $moduleTitle = 'StockTransaction';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'               => 'Id',
		'stock_id'         => 'Stock_id',
		'client_id'        => 'Client_id',
		'buy_price'        => 'Buy_price',
		'sell_price'       => 'Sell_price',
		'qty'              => 'Qty',
		'profit_loss'      => 'Profit_loss',
        'tax'              => 'Tax',
        'net_profit'       => 'Net P/L',
		'notes'            => 'Notes',
        "actions"          => "Actions"
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
		'stock_id' =>   [
                    'data'          => 'stock_id',
                    'name'          => 'stock_id',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'client_id' =>   [
                    'data'          => 'client_id',
                    'name'          => 'client_id',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'buy_price' =>   [
                    'data'          => 'buy_price',
                    'name'          => 'buy_price',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'sell_price' =>   [
                    'data'          => 'sell_price',
                    'name'          => 'sell_price',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'qty' =>   [
                    'data'          => 'qty',
                    'name'          => 'qty',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'profit_loss' =>   [
                    'data'          => 'profit_loss',
                    'name'          => 'profit_loss',
                    'searchable'    => true,
                    'sortable'      => true
                ],
        'tax' =>   [
                    'data'          => 'tax',
                    'name'          => 'tax',
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
        'listRoute'     => 'stocktransaction.index',
        'createRoute'   => 'stocktransaction.create',
        'storeRoute'    => 'stocktransaction.store',
        'editRoute'     => 'stocktransaction.edit',
        'updateRoute'   => 'stocktransaction.update',
        'deleteRoute'   => 'stocktransaction.destroy',
        'dataRoute'     => 'stocktransaction.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'stocktransaction.index',
        'createView'    => 'stocktransaction.create',
        'editView'      => 'stocktransaction.edit',
        'deleteView'    => 'stocktransaction.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new StockTransaction;
    }

    /**
     * Create StockTransaction
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
     * Update StockTransaction
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
     * Destroy StockTransaction
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
            ->with(['client', 'stock'])
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