<?php

namespace App\Repositories\MasterTable;

/**
 * Class EloquentMasterTableRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\MasterTable\MasterTable;
use App\Models\TableField\TableField;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;
use Artisan;
use App\Library\MigrationGenerator\MigrationGenerator;
use App\Library\ModuleRemover\ModuleRemover;

class EloquentMasterTableRepository extends DbRepository
{
    /**
     * MasterTable Model
     *
     * @var Object
     */
    public $model;

    /**
     * MasterTable Model
     *
     * @var Object
     */
    public $tableFieldModel;

    /**
     * MasterTable Title
     *
     * @var string
     */
    public $moduleTitle = 'MasterTable';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'                => 'Id',
        'title'             => 'Title',
        'module_name'       => 'Module Name',
        'notes'             => 'Migration File',
        'is_executed'       => 'Executed',
        'execute_date_time' => 'Execute DateTime',
        'is_migrated'       => 'Migrated',
        'migrated_date_time'=> 'Migrated At',
        'extra_notes'       => 'Notes',
        'created_at'        => 'Created At',
        'updated_at'        => 'Updated At',
        'deleted_at'        => 'Deleted At',
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
            'data'          => 'title',
            'name'          => 'title',
            'searchable'    => true,
            'sortable'      => true
        ],
        'module_name' =>   [
            'data'          => 'module_name',
            'name'          => 'module_name',
            'searchable'    => true,
            'sortable'      => true
        ],
        'notes' =>   [
            'data'          => 'notes',
            'name'          => 'notes',
            'searchable'    => true,
            'sortable'      => true
        ],
        'is_executed' =>   [
            'data'          => 'is_executed',
            'name'          => 'is_executed',
            'searchable'    => true,
            'sortable'      => true
        ],
        'execute_date_time' =>   [
            'data'          => 'execute_date_time',
            'name'          => 'execute_date_time',
            'searchable'    => true,
            'sortable'      => true
        ],
        'is_migrated' =>   [
            'data'          => 'is_migrated',
            'name'          => 'is_migrated',
            'searchable'    => true,
            'sortable'      => true
        ],
        'migrated_date_time' =>   [
            'data'          => 'migrated_date_time',
            'name'          => 'migrated_date_time',
            'searchable'    => true,
            'sortable'      => true
        ],
        'extra_notes' =>   [
            'data'          => 'extra_notes',
            'name'          => 'extra_notes',
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
		'deleted_at' =>   [
            'data'          => 'deleted_at',
            'name'          => 'deleted_at',
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
        'listRoute'     => 'mastertable.index',
        'createRoute'   => 'mastertable.create',
        'storeRoute'    => 'mastertable.store',
        'editRoute'     => 'mastertable.edit',
        'updateRoute'   => 'mastertable.update',
        'deleteRoute'   => 'mastertable.destroy',
        'dataRoute'     => 'mastertable.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'mastertable.index',
        'createView'    => 'mastertable.create',
        'editView'      => 'mastertable.edit',
        'deleteView'    => 'mastertable.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new MasterTable;
        $this->tableFieldModel = new TableField;
    }

    /**
     * Create MasterTable
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
            if($this->createTableFields($model, $input))
            {
                // Run Migration
                if($this->runMigration($model))
                {
                    $model->is_migrated = 1;
                    $model->migrated_date_time = date('Y-m-d H:i:s');

                    // Run Module Generator
                    if($this->runModuleGenerator($model))
                    {
                        $model->is_executed = 1;
                        $model->execute_date_time = date('Y-m-d H:i:s');
                    }

                    $model->save();
                }
                
                return $model;
            }
        }

        return false;
    }

    /**
     * Update MasterTable
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
     * Destroy MasterTable
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
            $moduleRemover = new ModuleRemover();
            $moduleRemover->run($model);
            
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
        // if($isCreate)
        // {
        //     $input = array_merge($input, ['user_id' => access()->user()->id]);
        // }

        $input = array_merge($input, ['notes' => strtolower($input['title']) . '_migration_file']);
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

    /**
     * Create Table Fields
     * 
     * @param Object $table
     * @param array $input
     * @return bool
     */
    public function createTableFields($table = null, $input = array())
    {
        $insertData = [];

        if(isset($table) && isset($input['field_name']) && count($input['field_name']))
        {
            for($i = 0; $i < count($input['field_name']); $i++)
            {
                $insertData[] = [
                    'master_table_id'   => $table->id,
                    'field_name'        => $input['field_name'][$i] ?? '',
                    'field_type'        => $input['field_type'][$i] ?? '',
                    'is_nullable'       => $input['is_nullable'][$i] ?? 0,
                    'is_primary_field'  => $input['is_primary_field'][$i] ?? 0,
                    'is_index_field'    => $input['is_index_field'][$i] ?? 0,
                    'is_unique_field'   => $input['is_unique_field'][$i] ?? 0,
                    'is_soft_delete'    => $input['is_soft_delete'][$i] ?? 0,
                    'default_value'     => $input['default_value'][$i],
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s'),
                ];
            }
        }

        if(isset($insertData) && count($insertData))
        {
            return $this->tableFieldModel->insert($insertData);
        }
        return true;
    }

    /**
     * Run Migration
     * 
     * @param Object $model
     * @return bool
     */
    public function runMigration($model)
    {
        $migGen = new MigrationGenerator();
        $migStatus = $migGen->generateMigrationFile($model, 
            $this->tableFieldModel->where('master_table_id', $model->id)->get()
        );

        if($migStatus)
        {
            Artisan::call('migrate');
            return true;
        }

        return false;
    }

    /**
     * Run Module Generator
     * 
     * @param Object $model
     * @return bool
     */
    public function runModuleGenerator($model)
    {
        Artisan::call('make:createCustomModule '. $model->module_name . ' ' . $model->title);
        return true;
    }   
}