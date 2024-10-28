<?php 

namespace App\Repositories\Transactions;

/**
 * Class EloquentTransactionsRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\Transactions\Transactions;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;
use App\Models\ClientDetail\ClientDetail; 
use App\Models\Main\Main;

class EloquentTransactionsRepository extends DbRepository
{
    /**
     * Transactions Model
     *
     * @var Object
     */
    public $model;

    /**
     * Transactions Title
     *
     * @var string
     */
    public $moduleTitle = 'Transactions';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'        => 'Id',
		'master_account_id'        => 'Master_account_id',
        'ipo_id'        => 'IPO',
		'client_id'        => 'Client_id',
		'debit'        => 'Debit',
		'credit'        => 'Credit',
		'amount'        => 'BALANCE',
		'notes'        => 'Notes',
		'transaction_date'        => 'Transaction_date',
		'created_by'        => 'Created_by',
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
        'master_account_id' =>   [
                    'data'          => 'master_account_id',
                    'name'          => 'master_account_id',
                    'searchable'    => true,
                    'sortable'      => true
                ],
        'ipo_id' =>   [
                    'data'          => 'ipo_id',
                    'name'          => 'ipo_id',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'client_id' =>   [
                    'data'          => 'client_id',
                    'name'          => 'client_id',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'debit' =>   [
                    'data'          => 'debit',
                    'name'          => 'debit',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'credit' =>   [
                    'data'          => 'credit',
                    'name'          => 'credit',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'amount' =>   [
                    'data'          => 'amount',
                    'name'          => 'amount',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'notes' =>   [
                    'data'          => 'notes',
                    'name'          => 'notes',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'transaction_date' =>   [
                    'data'          => 'transaction_date',
                    'name'          => 'transaction_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'created_by' =>   [
                    'data'          => 'created_by',
                    'name'          => 'created_by',
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
        'listRoute'     => 'transactions.index',
        'createRoute'   => 'transactions.create',
        'storeRoute'    => 'transactions.store',
        'editRoute'     => 'transactions.edit',
        'updateRoute'   => 'transactions.update',
        'deleteRoute'   => 'transactions.destroy',
        'dataRoute'     => 'transactions.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'transactions.index',
        'createView'    => 'transactions.create',
        'editView'      => 'transactions.edit',
        'deleteView'    => 'transactions.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new Transactions;
    }

    /**
     * Create Transactions
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
            $client = ClientDetail::where('id', $model->client_id)->first();
            $client->balance = $client->balance + $input['amount'];
            $client->save();

            $main = Main::first();
            $main->balance = $main->balance - $input['amount'];
            $main->save();

            return $model;
        }

        return false;
    }

    /**
     * Update Transactions
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
     * Destroy Transactions
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

        $input['master_account_id'] = 1;
        $input['credit'] = 1;
        $input['transaction_date'] = date('Y-m-d');
        $input['created_by'] = 1;

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