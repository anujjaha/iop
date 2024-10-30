<?php 

namespace App\Repositories\Stock;

/**
 * Class EloquentStockRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\Stock\Stock;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;
use App\Models\StockTransaction\StockTransaction;

class EloquentStockRepository extends DbRepository
{
    /**
     * Stock Model
     *
     * @var Object
     */
    public $model;

    /**
     * Stock Title
     *
     * @var string
     */
    public $moduleTitle = 'Stock';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'                => 'Id',
		'client_id'       => 'Client_id',
		'title'           => 'Title',
		'code'            => 'Code',
		'cost'            => 'Cost',
		'qty'             => 'Qty',
		'cmp'             => 'Cmp',
		'external_link'   => 'Info',
		'notes'           => 'Notes',
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
		'title' =>   [
                    'data'          => 'title',
                    'name'          => 'title',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'code' =>   [
                    'data'          => 'code',
                    'name'          => 'code',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'cost' =>   [
                    'data'          => 'cost',
                    'name'          => 'cost',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'qty' =>   [
                    'data'          => 'qty',
                    'name'          => 'qty',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'cmp' =>   [
                    'data'          => 'cmp',
                    'name'          => 'cmp',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'external_link' =>   [
                    'data'          => 'external_link',
                    'name'          => 'external_link',
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
        'listRoute'     => 'stock.index',
        'createRoute'   => 'stock.create',
        'storeRoute'    => 'stock.store',
        'editRoute'     => 'stock.edit',
        'updateRoute'   => 'stock.update',
        'deleteRoute'   => 'stock.destroy',
        'dataRoute'     => 'stock.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'stock.index',
        'createView'    => 'stock.create',
        'editView'      => 'stock.edit',
        'deleteView'    => 'stock.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new Stock;
    }

    /**
     * Create Stock
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
     * Update Stock
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
     * Destroy Stock
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

    public function sellStock($input)
    {
        $stockInfo = $this->model->where('id', $input['stockId'])->first();

        if(isset($stockInfo))
        {
            $transacionCost = $input['qty'] * $input['rate'];
            $profit = ($input['rate'] - $stockInfo->cost) * $input['qty'];
            $tax    = 0;
            if($profit > 0)
            {
                $tax = ($profit / 100 ) * get20TaxRate();
            }
            
            StockTransaction::create([
                'stock_id'      => $stockInfo->id,
                'client_id'     => $stockInfo->client_id,
                'buy_price'     => $stockInfo->cost,
                'sell_price'    => $input['rate'],
                'qty'           => $input['qty'],
                'profit_loss'   => $profit,
                'tax'           => $tax,
                'net_profit'    => $profit - $tax,
                'brokerage_cost' => getBrokerAmount($transacionCost),
                'notes'         => $input['notes']
            ]);

            $stockInfo->qty = $stockInfo->qty - $input['qty'];
            return $stockInfo->save();
        }

        return false;
    }
}