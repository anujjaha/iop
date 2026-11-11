<?php 

namespace App\Repositories\McxTrade;

/**
 * Class EloquentMcxTradeRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\McxTrade\McxTrade;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentMcxTradeRepository extends DbRepository
{
    /**
     * McxTrade Model
     *
     * @var Object
     */
    public $model;

    /**
     * McxTrade Title
     *
     * @var string
     */
    public $moduleTitle = 'McxTrade';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'              => 'Id',
		'client_id'       => 'Client',
		'tmonth'          => 'Month',
		'trade_type'      => 'Trade',
		'trade_date'      => 'Date',
		'mcx_code'        => 'Item',
		'qty'             => 'Qty',
		'buy_price'       => 'Buy',
		'sell_price'      => 'Sell',
		'profit_loss'     => 'P/L',
        'additional_total' => 'Extra',
        'net_profit_loss'     => 'Net P/L',
		'is_settle'       => 'Completed',
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
        'tmonth' =>   [
                    'data'          => 'tmonth',
                    'name'          => 'tmonth',
                    'searchable'    => true,
                    'sortable'      => true
                ],
        'trade_type' =>   [
                    'data'          => 'trade_type',
                    'name'          => 'trade_type',
                    'searchable'    => true,
                    'sortable'      => true
                ],
        'trade_date' =>   [
                    'data'          => 'trade_date',
                    'name'          => 'trade_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		
		'mcx_code' =>   [
                    'data'          => 'mcx_code',
                    'name'          => 'mcx_code',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'qty' =>   [
                    'data'          => 'qty',
                    'name'          => 'qty',
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
		'profit_loss' =>   [
                    'data'          => 'profit_loss',
                    'name'          => 'profit_loss',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'additional_total' =>   [
                    'data'          => 'additional_total',
                    'name'          => 'additional_total',
                    'searchable'    => true,
                    'sortable'      => true
                ],
        'net_profit_loss' =>   [
                    'data'          => 'net_profit_loss',
                    'name'          => 'net_profit_loss',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'is_settle' =>   [
                    'data'          => 'is_settle',
                    'name'          => 'is_settle',
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
        'listRoute'     => 'mcxtrade.index',
        'createRoute'   => 'mcxtrade.create',
        'storeRoute'    => 'mcxtrade.store',
        'editRoute'     => 'mcxtrade.edit',
        'updateRoute'   => 'mcxtrade.update',
        'deleteRoute'   => 'mcxtrade.destroy',
        'dataRoute'     => 'mcxtrade.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'mcxtrade.index',
        'createView'    => 'mcxtrade.create',
        'editView'      => 'mcxtrade.edit',
        'deleteView'    => 'mcxtrade.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new McxTrade;
    }

    /**
     * Create McxTrade
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
            $this->checkAndSettle($model);
            return $model;
        }

        return false;
    }

    /**
     * Update McxTrade
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
            $model->update($input);
            $updatedModel = $this->model->find($id);
            $this->checkAndSettle($updatedModel);
            return $updatedModel;

        }

        return false;
    }

    public function checkAndSettle($model)
    {
        if($model->is_settle === 1)
        {
            $buyPrice   = $model->buy_price;
            $sellPrice  = $model->sell_price;
            $additionalCost = $model->additional_bcost + $model->additional_scost;

            $profit     = $sellPrice - $buyPrice;

            $model->additional_total = $additionalCost;
            $model->profit_loss = $profit;
            $model->net_profit_loss = $profit - $additionalCost;
            $model->tmonth = date('M-Y');
            $model->save();
        }
        return true;
    }

    /**
     * Destroy McxTrade
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
            ->with(['clientInfo'])
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