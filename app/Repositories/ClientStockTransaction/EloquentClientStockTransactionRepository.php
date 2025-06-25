<?php 

namespace App\Repositories\ClientStockTransaction;

/**
 * Class EloquentClientStockTransactionRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\ClientStockTransaction\ClientStockTransaction;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentClientStockTransactionRepository extends DbRepository
{
    /**
     * ClientStockTransaction Model
     *
     * @var Object
     */
    public $model;

    /**
     * ClientStockTransaction Title
     *
     * @var string
     */
    public $moduleTitle = 'ClientStockTransaction';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        		'id'        => 'Id',
		'client_id'        => 'Client_id',
		'stock_id'        => 'Stock_id',
		'buy_cost'        => 'Buy_cost',
		'buy_qty'        => 'Buy_qty',
		'buy_date'        => 'Buy_date',
		'sell_cost'        => 'Sell_cost',
		'sell_qty'        => 'Sell_qty',
		'sell_date'        => 'Sell_date',
		'total_transaction_value'        => 'Total_transaction_value',
		'tax'        => 'Tax',
		'brokerage_percentage'        => 'Brokerage_percentage',
		'brokerage_cost'        => 'Brokerage_cost',
		'net_profit'        => 'Net_profit',
		'net_loss'        => 'Net_loss',
		'is_profit'        => 'Is_profit',
		'is_loss'        => 'Is_loss',
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
		'stock_id' =>   [
                    'data'          => 'stock_id',
                    'name'          => 'stock_id',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'buy_cost' =>   [
                    'data'          => 'buy_cost',
                    'name'          => 'buy_cost',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'buy_qty' =>   [
                    'data'          => 'buy_qty',
                    'name'          => 'buy_qty',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'buy_date' =>   [
                    'data'          => 'buy_date',
                    'name'          => 'buy_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'sell_cost' =>   [
                    'data'          => 'sell_cost',
                    'name'          => 'sell_cost',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'sell_qty' =>   [
                    'data'          => 'sell_qty',
                    'name'          => 'sell_qty',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'sell_date' =>   [
                    'data'          => 'sell_date',
                    'name'          => 'sell_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'total_transaction_value' =>   [
                    'data'          => 'total_transaction_value',
                    'name'          => 'total_transaction_value',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'tax' =>   [
                    'data'          => 'tax',
                    'name'          => 'tax',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'brokerage_percentage' =>   [
                    'data'          => 'brokerage_percentage',
                    'name'          => 'brokerage_percentage',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'brokerage_cost' =>   [
                    'data'          => 'brokerage_cost',
                    'name'          => 'brokerage_cost',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'net_profit' =>   [
                    'data'          => 'net_profit',
                    'name'          => 'net_profit',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'net_loss' =>   [
                    'data'          => 'net_loss',
                    'name'          => 'net_loss',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'is_profit' =>   [
                    'data'          => 'is_profit',
                    'name'          => 'is_profit',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'is_loss' =>   [
                    'data'          => 'is_loss',
                    'name'          => 'is_loss',
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
        'listRoute'     => 'clientstocktransaction.index',
        'createRoute'   => 'clientstocktransaction.create',
        'storeRoute'    => 'clientstocktransaction.store',
        'editRoute'     => 'clientstocktransaction.edit',
        'updateRoute'   => 'clientstocktransaction.update',
        'deleteRoute'   => 'clientstocktransaction.destroy',
        'dataRoute'     => 'clientstocktransaction.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'clientstocktransaction.index',
        'createView'    => 'clientstocktransaction.create',
        'editView'      => 'clientstocktransaction.edit',
        'deleteView'    => 'clientstocktransaction.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new ClientStockTransaction;
    }

    /**
     * Create ClientStockTransaction
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
     * Update ClientStockTransaction
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
     * Destroy ClientStockTransaction
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