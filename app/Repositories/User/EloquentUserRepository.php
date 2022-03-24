<?php

namespace App\Repositories\User;

/**
 * Class EloquentUserRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\User\User;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentUserRepository extends DbRepository
{
    /**
     * User Model
     *
     * @var Object
     */
    public $model;

    /**
     * User Model
     *
     * @var Object
     */
    public $tableFieldModel;

    /**
     * User Title
     *
     * @var string
     */
    public $moduleTitle = 'User';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'                => 'Id',
        'name'              => 'Name',
        'email'             => 'Email',
        'created_at'        => 'Created At',
        'updated_at'        => 'Updated At',
        "actions"           => "Actions"
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
        'title' =>   [
            'data'          => 'name',
            'name'          => 'name',
            'searchable'    => true,
            'sortable'      => true
        ],
        'email' =>   [
            'data'          => 'email',
            'name'          => 'email',
            'searchable'    => true,
            'sortable'      => true
        ],
        'created_at' =>   [
            'data'          => 'created_at',
            'name'          => 'created_at',
            'searchable'    => true,
            'sortable'      => true
        ],
        'updated_at' =>   [
            'data'          => 'updated_at',
            'name'          => 'updated_at',
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
        'listRoute'     => 'users.index',
        'createRoute'   => 'users.create',
        'storeRoute'    => 'users.store',
        'editRoute'     => 'users.edit',
        'updateRoute'   => 'users.update',
        'deleteRoute'   => 'users.destroy',
        'dataRoute'     => 'users.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'user.index',
        'createView'    => 'user.create',
        'editView'      => 'user.edit',
        'deleteView'    => 'user.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new User;
    }

    /**
     * Create User
     *
     * @param array $input
     * @return mixed
     */
    public function create($input)
    {
        $input = $this->prepareInputData($input, true);
        $model = $this->model->create($input);

        if ($model) {
            return $model;
        }

        return false;
    }

    /**
     * Update User
     *
     * @param int $id
     * @param array $input
     * @return bool|int|mixed
     */
    public function update($id, $input)
    {
        $model = $this->model->find($id);

        if ($model) {
            $input = $this->prepareInputData($input);

            return $model->update($input);
        }

        return false;
    }

    /**
     * Destroy User
     *
     * @param int $id
     * @return mixed
     * @throws GeneralException
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);

        if ($model) {
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
        if ($id) {
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
            $this->model->getTable() . '.*'
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
        return $input;
    }

    /**
     * Get Table Headers
     *
     * @return string
     */
    public function getTableHeaders()
    {
        if ($this->isAdmin) {
            return json_encode($this->setTableStructure($this->tableHeaders));
        }

        return json_encode($this->setTableStructure($this->tableHeaders));
    }

    /**
     * Get Table Columns
     *
     * @return string
     */
    public function getTableColumns()
    {
        if ($this->isAdmin) {
            return json_encode($this->setTableStructure($this->tableColumns));
        }

        $clientColumns = $this->tableColumns;

        unset($clientColumns['username']);

        return json_encode($this->setTableStructure($clientColumns));
    }
}