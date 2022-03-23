<?php namespace App\Repositories\TableField;

/**
 * Class EloquentTableFieldRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\TableField\TableField;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentTableFieldRepository extends DbRepository
{
    /**
     * TableField Model
     *
     * @var Object
     */
    public $model;

    /**
     * TableField Title
     *
     * @var string
     */
    public $moduleTitle = 'TableField';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'created_at'        => 'Created_at',
'default_value'        => 'Default_value',
'field_name'        => 'Field_name',
'field_type'        => 'Field_type',
'id'        => 'Id',
'is_index_field'        => 'Is_index_field',
'is_nullable'        => 'Is_nullable',
'is_primary_field'        => 'Is_primary_field',
'is_soft_delete'        => 'Is_soft_delete',
'is_unique_field'        => 'Is_unique_field',
'master_table_id'        => 'Master_table_id',
'updated_at'        => 'Updated_at',
"actions"         => "Actions"
    ];

    /**
     * Table Columns
     *
     * @var array
     */
    public $tableColumns = [
        'created_at' =>   [
                'data'          => 'created_at',
                'name'          => 'created_at',
                'searchable'    => true,
                'sortable'      => true
            ],
		'default_value' =>   [
                'data'          => 'default_value',
                'name'          => 'default_value',
                'searchable'    => true,
                'sortable'      => true
            ],
		'field_name' =>   [
                'data'          => 'field_name',
                'name'          => 'field_name',
                'searchable'    => true,
                'sortable'      => true
            ],
		'field_type' =>   [
                'data'          => 'field_type',
                'name'          => 'field_type',
                'searchable'    => true,
                'sortable'      => true
            ],
		'id' =>   [
                'data'          => 'id',
                'name'          => 'id',
                'searchable'    => true,
                'sortable'      => true
            ],
		'is_index_field' =>   [
                'data'          => 'is_index_field',
                'name'          => 'is_index_field',
                'searchable'    => true,
                'sortable'      => true
            ],
		'is_nullable' =>   [
                'data'          => 'is_nullable',
                'name'          => 'is_nullable',
                'searchable'    => true,
                'sortable'      => true
            ],
		'is_primary_field' =>   [
                'data'          => 'is_primary_field',
                'name'          => 'is_primary_field',
                'searchable'    => true,
                'sortable'      => true
            ],
		'is_soft_delete' =>   [
                'data'          => 'is_soft_delete',
                'name'          => 'is_soft_delete',
                'searchable'    => true,
                'sortable'      => true
            ],
		'is_unique_field' =>   [
                'data'          => 'is_unique_field',
                'name'          => 'is_unique_field',
                'searchable'    => true,
                'sortable'      => true
            ],
		'master_table_id' =>   [
                'data'          => 'master_table_id',
                'name'          => 'master_table_id',
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
        'listRoute'     => 'tablefield.index',
        'createRoute'   => 'tablefield.create',
        'storeRoute'    => 'tablefield.store',
        'editRoute'     => 'tablefield.edit',
        'updateRoute'   => 'tablefield.update',
        'deleteRoute'   => 'tablefield.destroy',
        'dataRoute'     => 'tablefield.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'tablefield.index',
        'createView'    => 'tablefield.create',
        'editView'      => 'tablefield.edit',
        'deleteView'    => 'tablefield.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new TableField;
    }

    /**
     * Create TableField
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
     * Update TableField
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
     * Destroy TableField
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