<?php 

namespace App\Repositories\IpoAssignments;

/**
 * Class EloquentIpoAssignmentsRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\IpoAssignments\IpoAssignments;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;
use App\Models\ClientDetail\ClientDetail;
use App\Models\IpoDetails\IpoDetails;
use App\Models\Main\Main;
use App\Models\Transactions\Transactions;

class EloquentIpoAssignmentsRepository extends DbRepository
{
    /**
     * IpoAssignments Model
     *
     * @var Object
     */
    public $model;

    /**
     * IpoAssignments Title
     *
     * @var string
     */
    public $moduleTitle = 'IpoAssignments';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'            => 'Id',
		'client_id'     => 'Client_id',
		'ipo_id'        => 'IPO',
        'ipo_amt'       => 'BLOCK',
		'status'        => 'Status',
		'profit_loss'   => 'Profit_loss',
		'applied_date'  => 'Applied_date',
		'revoked_date'  => 'Revoked_date',
		'alloted_date'  => 'Alloted_date',
		'refund_date'   => 'Refund_date',
		'opening_rate'  => 'Opening_rate',
		'sell_price'    => 'Sell_price',
		'sell_date'     => 'Sell_date',
		'return_date'   => 'Return_date',
		'notes'         => 'Notes',
        "actions"       => "Actions"
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
        'ipo_amt' =>   [
                    'data'          => 'ipo_amt',
                    'name'          => 'ipo_amt',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		
		
		'status' =>   [
                    'data'          => 'status',
                    'name'          => 'status',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'profit_loss' =>   [
                    'data'          => 'profit_loss',
                    'name'          => 'profit_loss',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'applied_date' =>   [
                    'data'          => 'applied_date',
                    'name'          => 'applied_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'revoked_date' =>   [
                    'data'          => 'revoked_date',
                    'name'          => 'revoked_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'alloted_date' =>   [
                    'data'          => 'alloted_date',
                    'name'          => 'alloted_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'refund_date' =>   [
                    'data'          => 'refund_date',
                    'name'          => 'refund_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'opening_rate' =>   [
                    'data'          => 'opening_rate',
                    'name'          => 'opening_rate',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'sell_price' =>   [
                    'data'          => 'sell_price',
                    'name'          => 'sell_price',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'sell_date' =>   [
                    'data'          => 'sell_date',
                    'name'          => 'sell_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'return_date' =>   [
                    'data'          => 'return_date',
                    'name'          => 'return_date',
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
        'listRoute'     => 'ipoassignments.index',
        'createRoute'   => 'ipoassignments.create',
        'storeRoute'    => 'ipoassignments.store',
        'editRoute'     => 'ipoassignments.edit',
        'updateRoute'   => 'ipoassignments.update',
        'deleteRoute'   => 'ipoassignments.destroy',
        'dataRoute'     => 'ipoassignments.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'ipoassignments.index',
        'createView'    => 'ipoassignments.create',
        'editView'      => 'ipoassignments.edit',
        'deleteView'    => 'ipoassignments.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new IpoAssignments;
    }

    /**
     * Create IpoAssignments
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
            $this->updateCustomerBalance($model);
            return $model;
        }

        return false;
    }

    /**
     * Update IpoAssignments
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
     * Destroy IpoAssignments
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
            ->with(['client', 'ipo'])->get();
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

    public function getClients()
    {
        return ClientDetail::all();
    }

    public function getActiveIpos()
    {
        return IpoDetails::whereDate('closing_date', '>=', date('Y-m-d'))->get();
    }

    public function getEligibleClientList($ipoId = null)
    {
        $clientIds = $this->model::select('client_id')->where('ipo_id', $ipoId)->get()->toArray();

        return ClientDetail::whereNotIn('id', $clientIds)->get();
    }

    /**
     * Update Customer Balance
     * 
     * @param object $ipoAssignment 
     */
    public function updateCustomerBalance($ipoAssignment)
    {
        $client = ClientDetail::where('id', $ipoAssignment->client_id)->first();
        $ipo    = IpoDetails::where('id', $ipoAssignment->ipo_id)->first();

        $client->balance = $client->balance - $ipo->block_amt;
        $client->save();

        $main = Main::where('id', 1)->first();
        $main->balance = $main->balance - $ipo->block_amt;
        $main->save();

        $lastTransaction = Transactions::orderBy('id','desc')->first();
        $lastBalance = 0;
        if($lastTransaction && isset($lastTransaction->id))
        {
            $main = Main::first();
            $lastBalance = $main->balance;
        }

        Transactions::create([
            'master_account_id' => 1,
            'ipo_id'            => $ipo->id,
            'client_id'         => $ipoAssignment->client_id,
            'debit'             => 1,
            'amount'            => $ipo->block_amt,
            'balance'           => ($lastBalance - $ipo->block_amt),
            'notes'             => 'Applied for IPO ' . $ipo->ipo_name,
            'transaction_date'  => date('Y-m-d'),
            'created_by'        => auth()->user()->id,
        ]);

        return $client;
    }

    public function revokeAssignment($assignmentId = null)
    {
        $ipoAssignment = $this->model->where('id', $assignmentId)->with(['client', 'ipo'])->first();

        $ipoAssignment->status      = 2;
        $ipoAssignment->profit_loss = 0;
        $ipoAssignment->revoked_date = date('Y-m-d');
        $ipoAssignment->refund_date = $ipoAssignment->ipo->refund_date;
        $ipoAssignment->return_date = date('Y-m-d');
        $ipoAssignment->save();

        
        ClientDetail::where('id', $ipoAssignment->client_id)->update([
            'balance' => $ipoAssignment->client->balance + $ipoAssignment->ipo->block_amt
        ]);

        
        $main = Main::where('id', 1)->first();
        $main->balance = $main->balance + $ipoAssignment->ipo->block_amt;
        $main->save();

        $lastTransaction = Transactions::orderBy('id','desc')->first();

        Transactions::create([
            'master_account_id' => 1,
            'ipo_id'            => $ipoAssignment->ipo->id,
            'client_id'         => $ipoAssignment->client_id,
            'credit'             => 1,
            'amount'            => $ipoAssignment->ipo->block_amt,
            'balance'           => $lastTransaction->balance + $ipoAssignment->ipo->block_amt,
            'notes'             => 'Revoke for IPO ' . $ipoAssignment->ipo->ipo_name,
            'transaction_date'  => date('Y-m-d'),
            'created_by'        => auth()->user()->id,
        ]);

        return true;
    }
}