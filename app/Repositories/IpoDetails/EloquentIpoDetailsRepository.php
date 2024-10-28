<?php 

namespace App\Repositories\IpoDetails;

/**
 * Class EloquentIpoDetailsRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\IpoDetails\IpoDetails;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentIpoDetailsRepository extends DbRepository
{
    /**
     * IpoDetails Model
     *
     * @var Object
     */
    public $model;

    /**
     * IpoDetails Title
     *
     * @var string
     */
    public $moduleTitle = 'IpoDetails';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        		'id'        => 'Id',
		'ipo_name'        => 'Ipo_name',
		'opening_date'        => 'Opening_date',
		'closing_date'        => 'Closing_date',
		'listing_date'        => 'Listing_date',
		'gmp_latest'        => 'Gmp_latest',
		'lot_size'        => 'Lot_size',
		'block_amt'        => 'Block_amt',
		'refund_date'        => 'Refund_date',
		'listed_price'        => 'Listed_price',
		'ipo_type'        => 'Ipo_type',
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
		'ipo_name' =>   [
                    'data'          => 'ipo_name',
                    'name'          => 'ipo_name',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'opening_date' =>   [
                    'data'          => 'opening_date',
                    'name'          => 'opening_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'closing_date' =>   [
                    'data'          => 'closing_date',
                    'name'          => 'closing_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'listing_date' =>   [
                    'data'          => 'listing_date',
                    'name'          => 'listing_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'gmp_latest' =>   [
                    'data'          => 'gmp_latest',
                    'name'          => 'gmp_latest',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'lot_size' =>   [
                    'data'          => 'lot_size',
                    'name'          => 'lot_size',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'block_amt' =>   [
                    'data'          => 'block_amt',
                    'name'          => 'block_amt',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'refund_date' =>   [
                    'data'          => 'refund_date',
                    'name'          => 'refund_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'listed_price' =>   [
                    'data'          => 'listed_price',
                    'name'          => 'listed_price',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'ipo_type' =>   [
                    'data'          => 'ipo_type',
                    'name'          => 'ipo_type',
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
        'listRoute'     => 'ipodetails.index',
        'createRoute'   => 'ipodetails.create',
        'storeRoute'    => 'ipodetails.store',
        'editRoute'     => 'ipodetails.edit',
        'updateRoute'   => 'ipodetails.update',
        'deleteRoute'   => 'ipodetails.destroy',
        'dataRoute'     => 'ipodetails.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'ipodetails.index',
        'createView'    => 'ipodetails.create',
        'editView'      => 'ipodetails.edit',
        'deleteView'    => 'ipodetails.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new IpoDetails;
    }

    /**
     * Create IpoDetails
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
     * Update IpoDetails
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
     * Destroy IpoDetails
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