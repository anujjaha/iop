<?php 

namespace App\Repositories\DigiDocuments;

/**
 * Class EloquentDigiDocumentsRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\DigiDocuments\DigiDocuments;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentDigiDocumentsRepository extends DbRepository
{
    /**
     * DigiDocuments Model
     *
     * @var Object
     */
    public $model;

    /**
     * DigiDocuments Title
     *
     * @var string
     */
    public $moduleTitle = 'DigiDocuments';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        		'id'        => 'Id',
		'user_id'         => 'Client',
		'category'        => 'Category',
		'title'        => 'Title',
		'attachment'        => 'View',
		'is_aadhar_pan_link'        => 'Is_aadhar_pan_link',
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
		'user_id' =>   [
                    'data'          => 'user_id',
                    'name'          => 'user_id',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'category' =>   [
                    'data'          => 'category',
                    'name'          => 'category',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'title' =>   [
                    'data'          => 'title',
                    'name'          => 'title',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'attachment' =>   [
                    'data'          => 'attachment',
                    'name'          => 'attachment',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'is_aadhar_pan_link' =>   [
                    'data'          => 'is_aadhar_pan_link',
                    'name'          => 'is_aadhar_pan_link',
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
        'listRoute'     => 'digidocuments.index',
        'createRoute'   => 'digidocuments.create',
        'storeRoute'    => 'digidocuments.store',
        'editRoute'     => 'digidocuments.edit',
        'updateRoute'   => 'digidocuments.update',
        'deleteRoute'   => 'digidocuments.destroy',
        'dataRoute'     => 'digidocuments.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'digidocuments.index',
        'createView'    => 'digidocuments.create',
        'editView'      => 'digidocuments.edit',
        'deleteView'    => 'digidocuments.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new DigiDocuments;
    }

    /**
     * Create DigiDocuments
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
     * Update DigiDocuments
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
     * Destroy DigiDocuments
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
        return $this->model->select($this->getTableFields())->with(['client'])->get();
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
           // $input = array_merge($input, ['user_id' => access()->user()->id]);
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