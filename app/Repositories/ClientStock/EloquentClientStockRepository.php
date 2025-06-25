<?php 

namespace App\Repositories\ClientStock;

/**
 * Class EloquentClientStockRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\ClientStock\ClientStock;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;
use App\Models\ClientStockTransaction\ClientStockTransaction;

class EloquentClientStockRepository extends DbRepository
{
    /**
     * ClientStock Model
     *
     * @var Object
     */
    public $model;

    /**
     * ClientStock Title
     *
     * @var string
     */
    public $moduleTitle = 'ClientStock';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        		'id'        => 'Id',
		'client_id'        => 'Client_id',
		'stock_id'        => 'Stock_id',
		'buy_qty'        => 'Buy_qty',
		'buy_cost'        => 'Buy_cost',
		'buy_date'        => 'Buy_date',
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
		'buy_qty' =>   [
                    'data'          => 'buy_qty',
                    'name'          => 'buy_qty',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'buy_cost' =>   [
                    'data'          => 'buy_cost',
                    'name'          => 'buy_cost',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'buy_date' =>   [
                    'data'          => 'buy_date',
                    'name'          => 'buy_date',
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
        'listRoute'     => 'clientstock.index',
        'createRoute'   => 'clientstock.create',
        'storeRoute'    => 'clientstock.store',
        'editRoute'     => 'clientstock.edit',
        'updateRoute'   => 'clientstock.update',
        'deleteRoute'   => 'clientstock.destroy',
        'dataRoute'     => 'clientstock.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'clientstock.index',
        'createView'    => 'clientstock.create',
        'editView'      => 'clientstock.edit',
        'deleteView'    => 'clientstock.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new ClientStock;
    }

    /**
     * Create ClientStock
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
     * Update ClientStock
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
     * Destroy ClientStock
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
        return $this->model->create([
            'client_id' => $input['clientId'],
            'stock_id'  => $input['stockId'],
            'buy_qty'   => $input['qty'],
            'buy_cost'  => $input['cost'],
            'buy_date'  => $input['date'],
        ]);
    }

    public function settle($input = [])
    {
        $clientStock = $this->model->where('id', $input['stockId'])
            ->first();

        if(isset($clientStock))
        {
            $totalValue         = $input['cost'] * $input['qty'];
            $totalInvestment    = $clientStock->buy_cost * $input['qty'];
            $profit             = 0;
            $loss               = 0;
            $isProfit           = 0;
            $isLoss             = 1;
            $tax                = 0;
            $brokerage          = getBrokerAmount($totalValue);
            $netProfit          = 0;

            if($totalValue > $totalInvestment)
            {
                $profit     = $totalValue - $totalInvestment;
                $tax        = $profit / 100 * get15TaxRate();
                $isProfit   = 1;
                $isLoss     = 0;
                $netProfit  = $profit - $tax - $brokerage;
            }
            else
            {
                $loss = ($totalInvestment + $brokerage) - $totalValue;
            }

            // create stock transaction
            ClientStockTransaction::create([
                'client_id'                 => $input['clientId'],
                'stock_id'                  => $clientStock->stock_id,
                'buy_cost'                  => $clientStock->buy_cost,
                'buy_qty'                   => $clientStock->buy_qty,
                'buy_date'                  => $clientStock->buy_date,
                'sell_cost'                 => $input['cost'],
                'sell_qty'                  => $input['qty'],
                'sell_date'                 => $input['date'],
                'total_transaction_value'   => $totalValue,
                'tax'                       => $tax,
                'brokerage_percentage'      => 0.25,
                'brokerage_cost'            => $brokerage,
                'net_value'                 => $profit,
                'net_profit'                => $netProfit,
                'net_loss'                  => $loss,
                'is_profit'                 => $isProfit,
                'is_loss'                   => $isLoss,
            ]);

            if($clientStock->buy_qty == $input['qty'])
            {
                $clientStock->delete();
            }
            else
            {
                $clientStock->buy_qty = $clientStock->buy_qty - $input['qty'];
                $clientStock->save();
            }
        }
        return true;
    }
}