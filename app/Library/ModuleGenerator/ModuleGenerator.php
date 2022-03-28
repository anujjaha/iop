<?php

namespace App\Library\ModuleGenerator;

use File;
use Schema;
use App\Models\TableField\TableField;
use App\Models\MasterTable\MasterTable;

/**
 * Class Module Generator.
 *
 * @author Anuj Jaha
 */
class ModuleGenerator
{
    protected $moduleName;

    protected $routePath = 'routes/Backend';
    protected $modelPath = 'app/Models';
    protected $controllerPath = 'app/Http/Controllers/Backend';
    protected $eloquentPath = 'app/Repositories';
    protected $viewPath = 'resources/views';
    protected $apiRoutePath = 'routes/API';
    protected $apiControllerPath = 'app/Http/Controllers/Api';
    protected $apiTransformPath = 'app/Http/Transformers';

    public $createModuleViewFilePath;
    public $commonModuleViewFilePath;
    protected $createModuleViewFiles = [
        'create.blade.php',
        'edit.blade.php',
        'index.blade.php',
    ];

    protected $commonModuleViewFiles = [
        'form.blade.php',
        'header-buttons.blade.php',
    ];

    protected $tableName;

    public function __construct($moduleName)
    {
        $this->moduleName = ucfirst($moduleName);
        $this->tableName = 'data_table_name';
        $this->createModuleViewFilePath = storage_path() . DIRECTORY_SEPARATOR . 'commonview' . DIRECTORY_SEPARATOR . 'module-view';
        $this->commonModuleViewFilePath = storage_path() . DIRECTORY_SEPARATOR . 'commonview' . DIRECTORY_SEPARATOR . 'common-view';
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setTableName($name = null)
    {
        $this->tableName = isset($name) ? $name : 'data_table_name';

        return $this;
    }

    public function generateRoute()
    {
        $routePath = base_path() . DIRECTORY_SEPARATOR . $this->routePath;
        $fileName = $this->moduleName . '.php';
        $file = $routePath . DIRECTORY_SEPARATOR . $fileName;
        $content = $this->getRouteTemplate($this->moduleName);

        if (!is_writable($routePath)) {
            // Change Folder Permission
            //chmod($routePath, 0755);
            exec('sudo chmod ' . $routePath . ' 777');
        }

        $status = File::put($file, $content);

        if ($status) {
            //chmod($file, 0777);
            exec('sudo chmod ' . $file . ' 777');

            return true;
        }

        return false;
    }

    public function generateModel()
    {
        $modelPath = base_path() . DIRECTORY_SEPARATOR . $this->modelPath;
        $fileName = $this->moduleName . '.php';

        if (!is_dir($modelPath . DIRECTORY_SEPARATOR . $this->moduleName)) {
            mkdir($modelPath . DIRECTORY_SEPARATOR . $this->moduleName, 0777, true);
        }

        $filePath = $modelPath . DIRECTORY_SEPARATOR . $this->moduleName;
        $file = $filePath . DIRECTORY_SEPARATOR . $fileName;
        $content = $this->getModelTemplate($this->moduleName, $this->tableName);
        $status = $this->generateContent($filePath, $file, $content);

        if ($status) {
            $this->generateModelRelationship($filePath);
            $this->generateModelAttribute($filePath);
        }

        return $status;
    }

    public function generateModuleView($moduleName = null, $tableName = null)
    {
        $moduleName = isset($moduleName) ? $moduleName : $this->moduleName;
        $tableName = isset($tableName) ? $tableName : $this->tableName;
        $viewPath = base_path() . DIRECTORY_SEPARATOR . $this->viewPath;
        $backendPath = $viewPath . DIRECTORY_SEPARATOR . 'backend';
        $commonPath = $viewPath . DIRECTORY_SEPARATOR . 'common';
        $baseBackendPath = $backendPath . DIRECTORY_SEPARATOR . strtolower($moduleName);
        $baseCommonPath = $commonPath . DIRECTORY_SEPARATOR . strtolower($moduleName);
        $commonFormFile = 'form.blade.php';

        if (!is_dir($baseBackendPath)) {
            mkdir($baseBackendPath, 0777, true);
        }

        if (!is_dir($baseCommonPath)) {
            mkdir($baseCommonPath, 0777, true);
        }

        foreach ($this->createModuleViewFiles as $viewFile) {
            copy($this->createModuleViewFilePath . DIRECTORY_SEPARATOR . $viewFile, $baseBackendPath . DIRECTORY_SEPARATOR . $viewFile);
            @chmod($baseBackendPath . DIRECTORY_SEPARATOR . $viewFile, 0777);
        }

        foreach ($this->commonModuleViewFiles as $viewFile) {
            copy($this->commonModuleViewFilePath . DIRECTORY_SEPARATOR . $viewFile, $baseCommonPath . DIRECTORY_SEPARATOR . $viewFile);
            @chmod($baseCommonPath . DIRECTORY_SEPARATOR . $viewFile, 0777);
        }

        $formFile = $baseCommonPath . DIRECTORY_SEPARATOR . $commonFormFile;
        $formHTML = '';
        $columns = Schema::getColumnListing($tableName);

        foreach ($columns as $column) {
            if ($column == 'id' || $column == 'created_at' || $column == 'updated_at') {
                continue;
            }

            $fieldTitle = ucwords(str_replace('_', ' ', $column));
            $formHTML .= <<<EOD
<div class="form-group">
    {{ Form::label('$column', '$fieldTitle :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('$column', null, ['class' => 'form-control', 'placeholder' => '$fieldTitle', 'required' => 'required']) }}
    </div>
</div>
EOD;
        }

        File::put($formFile, $formHTML);
        //File::put($this->commonModuleViewFilePath . DIRECTORY_SEPARATOR . 'details.txt', 'Tabel Name ' . $table);

        return true;
    }

    public function generateModelRelationship($filepath)
    {
        $basePath = $filepath . DIRECTORY_SEPARATOR . 'Traits' . DIRECTORY_SEPARATOR . 'Relationship';

        if (!is_dir($basePath)) {
            mkdir($basePath, 0777, true);
        }

        $file = $basePath . DIRECTORY_SEPARATOR . 'Relationship.php';
        $content = $this->getRelationshipContent();

        return $this->generateContent($basePath, $file, $content);
    }

    public function generateModelAttribute($filepath)
    {
        $basePath = $filepath . DIRECTORY_SEPARATOR . 'Traits' . DIRECTORY_SEPARATOR . 'Attribute';

        if (!is_dir($basePath)) {
            mkdir($basePath, 0777, true);
        }

        $file = $basePath . DIRECTORY_SEPARATOR . 'Attribute.php';
        $content = $this->getModelAttributeContent();

        return $this->generateContent($basePath, $file, $content);
    }

    public function generateContent($filePath, $file, $content)
    {
        if (!is_writable($filePath)) {
            // Change Folder Permission
            //chmod($filePath, 0755);
            exec('sudo chmod ' . $filePath . ' 777');
        }

        $status = File::put($file, $content);

        if ($status) {
            exec('sudo chmod ' . $file . ' 777');
            //chmod($file, 0777);

            return true;
        }

        return false;
    }

    public function generateController()
    {
        $basePath = base_path() . DIRECTORY_SEPARATOR . $this->controllerPath;
        $fileName = 'Admin' . $this->moduleName . 'Controller.php';

        if (!is_dir($basePath . DIRECTORY_SEPARATOR . $this->moduleName)) {
            mkdir($basePath . DIRECTORY_SEPARATOR . $this->moduleName, 0777, true);
        }

        $filePath = $basePath . DIRECTORY_SEPARATOR . $this->moduleName;
        $file = $filePath . DIRECTORY_SEPARATOR . $fileName;
        $content = $this->getControllerTemplate($this->moduleName);

        if (!is_writable($filePath)) {
            // Change Folder Permission
            chmod($filePath, 0755);
        }

        $status = File::put($file, $content);

        if ($status) {
            chmod($file, 0777);

            return true;
        }

        return false;
    }

    public function generateAPIRoute()
    {
        $basePath = base_path() . DIRECTORY_SEPARATOR . $this->apiRoutePath;
        $fileName = ucfirst($this->moduleName) . '.php';

        if (!is_dir($basePath)) {
            mkdir($basePath, 0777, true);
        }

        $file = $basePath . DIRECTORY_SEPARATOR . $fileName;
        $content = $this->getAPIRouteTemplate($this->moduleName);
        $status = File::put($file, $content);

        if ($status) {
            chmod($file, 0777);

            return true;
        }

        return false;
    }

    public function generateAPIController()
    {
        $basePath = base_path() . DIRECTORY_SEPARATOR . $this->apiControllerPath;
        $fileName = 'API' . ucfirst($this->moduleName) . 'Controller.php';

        if (!is_dir($basePath)) {
            mkdir($basePath, 0777, true);
        }

        $file = $basePath . DIRECTORY_SEPARATOR . $fileName;
        $content = $this->getAPIControllerTemplate($this->moduleName);
        $status = File::put($file, $content);

        if ($status) {
            chmod($file, 0777);

            return true;
        }

        return false;
    }

    /**
     * Get Table Columns
     *
     * @param string $moduleName
     * @return Object
     */
    public function getTableColumns($moduleName = null)
    {
        return MasterTable::where([
                'module_name' => $moduleName
            ])
            ->with(['table_fields'])
            ->first();
    }   

    public function generateAPITransformer($alias = null)
    {
        $basePath = base_path() . DIRECTORY_SEPARATOR . $this->apiTransformPath;
        $fileName = ucfirst($this->moduleName) . 'Transformer.php';
        $moduleConfig = $this->getTableColumns($this->moduleName);

        if (!is_dir($basePath)) {
            mkdir($basePath, 0777, true);
        }

        $file = $basePath . DIRECTORY_SEPARATOR . $fileName;
        $content = $this->getAPITransformerTemplate($alias, null, $moduleConfig ?? null);
        $status = File::put($file, $content);

        if ($status) {
            //chmod($file, 0777);
            exec('sudo chmod ' . $file . ' 777');

            return true;
        }

        return false;
    }

    /**
     * Get Cast Field Type
     *
     * @param string $field
     */
    public function getCastFieldType($field = null)
    {
        if(isset($field) && !empty($field))
        {
            switch($field)
            {
                case 'int':
                    return 'int';
                break;
            }
        }

        return 'string';
    }

    public function getAPITransformerTemplate($alias = null, $tableName = null, $moduleConfig = null)
    {
        $moduleName = isset($moduleName) ? $moduleName : $this->moduleName;
        $tableName = isset($tableName) ? $tableName : $this->tableName;
        $keyword = '###MODULE-NAME###';
        $lowerCaseKey = '###LOWER-CASE-NAME###';
        $lowerCase = $alias ? $alias : strtolower($moduleName);
        $change = $moduleName;

        if(isset($moduleConfig) && !empty($moduleConfig))
        {
            // Check Table Schema
            $columns = $moduleConfig->table_fields;

            $lineBreak = "\n\t\t\t";
            $text = '';
            $sr = 0;
            foreach ($columns as $column) {
                $text .=  '"'. ($column->field_name) . '" => (' . $column->field_type . ') ##$##item->' . $column->field_name . ',' . $lineBreak;
                $sr++;
            }
        }
        else
        {
            // Check Table Schema
            $columns = Schema::getColumnListing($tableName);

            $text = '';
            $sr = 0;
            foreach ($columns as $column) {
                $first = $sr == 0 ? '' : '';
                $text .= '"###LOWER-CASE-NAME###' . ucfirst(camel_case($column)) . '" => ' . $first . ' ##$##item->' . $column . ', ';
                $sr++;
            }
        }
        
        $html = <<<EOD
<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class ###MODULE-NAME###Transformer extends Transformer
{
    /**
     * Transform
     *
     * @param array ##$##data
     * @return array
     */
    public function transform(##$##item)
    {
        if(is_array(##$##item))
        {
            ##$##item = (object)##$##item;
        }

        return [
EOD;
$html .= $lineBreak. $text .'
        ];
    }
}';
        $html = str_replace('##$##', '$', $html);
        $html = str_replace($lowerCaseKey, $lowerCase, $html);

        return str_replace($keyword, $change, $html);
    }

    public function generateEloquent()
    {
        $basePath = base_path() . DIRECTORY_SEPARATOR . $this->eloquentPath;
        $fileName = 'Eloquent' . $this->moduleName . 'Repository.php';

        if (!is_dir($basePath . DIRECTORY_SEPARATOR . $this->moduleName)) {
            mkdir($basePath . DIRECTORY_SEPARATOR . $this->moduleName, 0777, true);
        }

        $filePath = $basePath . DIRECTORY_SEPARATOR . $this->moduleName;
        $file = $filePath . DIRECTORY_SEPARATOR . $fileName;
        $content = $this->getEloquentTemplate($this->moduleName);

        if (!is_writable($filePath)) {
            // Change Folder Permission
            //chmod($filePath, 0755);
            exec('sudo chmod ' . $file . ' 777');
        }

        $status = File::put($file, $content);

        if ($status) {
            //chmod($file, 0777);
            exec('sudo chmod ' . $file . ' 777');

            return true;
        }

        return false;
    }

    public function generateViews()
    {
    }

    public function getAPIControllerTemplate()
    {
        $moduleName = isset($moduleName) ? $moduleName : $this->moduleName;
        $keyword = '###MODULE-NAME###';
        $lowerCaseKey = '###LOWER-CASE-NAME###';
        $lowerCase = strtolower($moduleName);
        $change = $moduleName;
        $html = <<<EOD
<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Transformers\###MODULE-NAME###Transformer;
use App\Http\Controllers\Api\BaseApiController;
use App\Repositories\###MODULE-NAME###\Eloquent###MODULE-NAME###Repository;

class API###MODULE-NAME###Controller extends BaseApiController
{
    /**
     * ###MODULE-NAME### Transformer
     *
     * @var Object
     */
    protected ##$#####LOWER-CASE-NAME###Transformer;

    /**
     * Repository
     *
     * @var Object
     */
    protected ##$##repository;

    /**
     * PrimaryKey
     *
     * @var string
     */
    protected ##$##primaryKey = '###LOWER-CASE-NAME###Id';

    /**
     * __construct
     *
     */
    public function __construct()
    {
        ##$##this->repository                       = new Eloquent###MODULE-NAME###Repository();
        ##$##this->###LOWER-CASE-NAME###Transformer = new ###MODULE-NAME###Transformer();
    }

    /**
     * List of All ###MODULE-NAME###
     *
     * @param Request ##$##request
     * @return json
     */
    public function index(Request ##$##request)
    {
        ##$##paginate   = ##$##request->get('paginate') ? ##$##request->get('paginate') : false;
        ##$##orderBy    = ##$##request->get('orderBy') ? ##$##request->get('orderBy') : 'id';
        ##$##order      = ##$##request->get('order') ? ##$##request->get('order') : 'ASC';
        ##$##items      = ##$##paginate ? ##$##this->repository->model->orderBy(##$##orderBy, ##$##order)->paginate(##$##paginate)->items() : ##$##this->repository->getAll(##$##orderBy, ##$##order);

        if(isset(##$##items) && count(##$##items))
        {
            ##$##itemsOutput = ##$##this->###LOWER-CASE-NAME###Transformer->transformCollection(##$##items);

            return ##$##this->successResponse(##$##itemsOutput);
        }

        return ##$##this->setStatusCode(400)->failureResponse([
            'message' => 'Unable to find ###MODULE-NAME###!'
            ], 'No ###MODULE-NAME### Found !');
    }

    /**
     * Create New (Store)
     *
     * @param Request ##$##request
     * @return string
     */
    public function store(Request ##$##request)
    {
        ##$##model = ##$##this->repository->create(##$##request->all());

        if(##$##model)
        {
            ##$##responseData = ##$##this->###LOWER-CASE-NAME###Transformer->transform(##$##model);

            return ##$##this->successResponse(##$##responseData, '###MODULE-NAME### is Created Successfully');
        }

        return ##$##this->setStatusCode(400)->failureResponse([
            'reason' => 'Invalid Inputs'
            ], 'Something went wrong !');
    }

    /**
     * View
     *
     * @param Request ##$##request
     * @param Int ##$##id
     * @return string
     */
    public function show(Request ##$##request, ##$##id = null)
    {
        ##$##itemId = (int) hasher()->decode(##$##id);

        if(##$##itemId)
        {
            ##$##itemData = ##$##this->repository->getById(##$##itemId);

            if(##$##itemData)
            {
                ##$##responseData = ##$##this->###LOWER-CASE-NAME###Transformer->transform(##$##itemData);

                return ##$##this->successResponse(##$##responseData, 'View Item');
            }
        }

        return ##$##this->setStatusCode(400)->failureResponse([
            'reason' => 'Invalid Inputs or Item not exists !'
            ], 'Something went wrong !');
    }

    /**
     * Update
     *
     * @param Request ##$##request
     * @param int ##$##id
     * @return string
     */
    public function update(Request ##$##request, ##$##id = null)
    {
        ##$##itemId = (int) hasher()->decode(##$##id);

        if(##$##itemId)
        {
            ##$##status = ##$##this->repository->update(##$##itemId, ##$##request->all());

            if(##$##status)
            {
                ##$##itemData       = ##$##this->repository->getById(##$##itemId);
                ##$##responseData   = ##$##this->###LOWER-CASE-NAME###Transformer->transform(##$##itemData);

                return ##$##this->successResponse(##$##responseData, '###MODULE-NAME### is Edited Successfully');
            }
        }

        return ##$##this->setStatusCode(400)->failureResponse([
            'reason' => 'Invalid Inputs'
        ], 'Something went wrong !');
    }

    /**
     * Delete ( Destroy )
     *
     * @param Request ##$##request
     * @return string
     */
    public function destroy(Request ##$##request, ##$##id = null)
    {
        ##$##itemId = (int) hasher()->decode(##$##id);

        if(##$##itemId)
        {
            ##$##status = ##$##this->repository->destroy(##$##itemId);

            if(##$##status)
            {
                return ##$##this->successResponse([
                    'success' => '###MODULE-NAME### Deleted'
                ], '###MODULE-NAME### is Deleted Successfully');
            }
        }

        return ##$##this->setStatusCode(404)->failureResponse([
            'reason' => 'Invalid Inputs'
        ], 'Something went wrong !');
    }
}
EOD;

        $html = str_replace('##$##', '$', $html);
        $html = str_replace($lowerCaseKey, $lowerCase, $html);

        return str_replace($keyword, $change, $html);
    }

    public function getAPIRouteTemplate($moduleName = null)
    {
        $moduleName = isset($moduleName) ? $moduleName : $this->moduleName;
        $keyword = '###MODULE-NAME###';
        $moduleRoutePrefix = strtolower($moduleName);
        $change = $moduleName;
        $html = <<<EOD
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\API###MODULE-NAME###Controller;

Route::apiResource('$moduleRoutePrefix', API###MODULE-NAME###Controller::class);
?>
EOD;

return str_replace($keyword, $change, $html);
}

public function getRelationshipContent($moduleName = null)
    {
        $moduleName = isset($moduleName) ? $moduleName : $this->moduleName;
        $keyword = '###MODULE-NAME###';
        $change = $moduleName;
        $html = <<<EOD
<?php namespace App\Models\###MODULE-NAME###\Traits\Relationship;

trait Relationship
{
}
EOD;

        return str_replace($keyword, $change, $html);
    }

    public function getModelAttributeContent($moduleName = null)
    {
        $moduleName = isset($moduleName) ? $moduleName : $this->moduleName;
        $moduleRoutePrefix = strtolower($moduleName);
        $keyword = '###MODULE-NAME###';
        $change = $moduleName;
        $html = <<<EOD
<?php 

namespace App\Models\###MODULE-NAME###\Traits\Attribute;

/**
 * Trait Attribute
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com )
 */

use App\Repositories\###MODULE-NAME###\Eloquent###MODULE-NAME###Repository;

trait Attribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute(##$##routes, ##$##prefix = 'admin', ##$##isAdmin = false)
    {
        ##$##id = ##$##isAdmin ? ##$##this->id : hasher()->encode(##$##this->id);

        return '<a href="'.route(##$##prefix .'.'. ##$##routes->editRoute, ##$##id).'" class="btn btn-xs btn-primary"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute(##$##routes, ##$##prefix = 'admin')
    {
        return '<a href="'.route(##$##prefix .'.'. ##$##routes->deleteRoute, ##$##this).'"
                data-method="delete"
                data-trans-button-cancel="Cancel"
                data-trans-button-confirm="Delete"
                data-trans-title="Do you want to Delete this Item ?"
                class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        ##$##repository = new Eloquent###MODULE-NAME###Repository;
        ##$##routes     = ##$##repository->getModuleRoutes();

        return ##$##this->getEditButtonAttribute(##$##routes, ##$##repository->clientRoutePrefix) . ##$##this->getDeleteButtonAttribute(##$##routes, ##$##repository->clientRoutePrefix);
    }

    /**
     * @return string
     */
    public function getAdminActionButtonsAttribute()
    {
        ##$##repository = new Eloquent###MODULE-NAME###Repository;
        ##$##routes     = ##$##repository->getModuleRoutes();

        return ##$##this->getEditButtonAttribute(##$##routes, ##$##repository->adminRoutePrefix, true) . ##$##this->getDeleteButtonAttribute(##$##routes, ##$##repository->adminRoutePrefix);
    }
}
EOD;
        $html = str_replace('##$##', '$', $html);

        return str_replace($keyword, $change, $html);
    }

    public function getRouteTemplate($moduleName = null)
    {
        $moduleName = isset($moduleName) ? $moduleName : $this->moduleName;
        $moduleRoutePrefix = strtolower($moduleName);
        $keyword = '###MODULE-NAME###';
        $change = $moduleName;
        $html = <<<EOD
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\###MODULE-NAME###\Admin###MODULE-NAME###Controller;

Route::group([], function () {
    /*
     * Admin ###MODULE-NAME### Controller
     */

    // Route for Ajax DataTable
    Route::get("$moduleRoutePrefix/get", [Admin###MODULE-NAME###Controller::class, 'getTableData'])->name("$moduleRoutePrefix.get-list-data");

    Route::resource("$moduleRoutePrefix", Admin###MODULE-NAME###Controller::class);
});
EOD;

        return str_replace($keyword, $change, $html);
    }

    public function getModelTemplate($moduleName = null, $tableName = null)
    {
        $moduleName = isset($moduleName) ? $moduleName : $this->moduleName;
        $tableName = isset($tableName) ? $tableName : $this->tableName;
        $moduleRoutePrefix = strtolower($moduleName);
        $keyword = '###MODULE-NAME###';
        $tableKey = '###TABLE-NAME###';
        $timeStamp = '###TABLE-TIMESTAMP###';
        $change = $moduleName;

        // Check Table Schema
        $columns = Schema::getColumnListing($tableName);

        $fillable = '';
        foreach ($columns as $column) {
            $fillable .= '"' . $column . '", ';
        }

        $html = <<<EOD
<?php 

namespace App\Models\###MODULE-NAME###;

/**
 * Class ###MODULE-NAME###
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\###MODULE-NAME###\Traits\Attribute\Attribute;
use App\Models\###MODULE-NAME###\Traits\Relationship\Relationship;

class ###MODULE-NAME### extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected ##$##table = "###TABLE-NAME###";

    /**
     * Fillable Database Fields
     *
     */
    protected ##$##fillable = [
        $fillable
    ];

    /**
     * Timestamp flag
     *
     */
    public ##$##timestamps = ###TABLE-TIMESTAMP###;

    /**
     * Guarded ID Column
     *
     */
    protected ##$##guarded = ["id"];
}
EOD;

        // Check Table Schema
        $columns = Schema::getColumnListing($tableName);

        // Set Timestamp Flag
        if (in_array('created_at', $columns) && in_array('updated_at', $columns)) {
            $html = str_replace('###TABLE-TIMESTAMP###', 'true', $html);
        } else {
            $html = str_replace('###TABLE-TIMESTAMP###', 'false', $html);
        }

        $html = str_replace('##$##', '$', $html);
        $html = str_replace($tableKey, $tableName, $html);

        return str_replace($keyword, $change, $html);
    }

    public function getControllerTemplate($moduleName = null, $tableName = null)
    {
        $moduleName = isset($moduleName) ? $moduleName : $this->moduleName;
        $moduleRoutePrefix = strtolower($moduleName);
        $keyword = '###MODULE-NAME###';
        $change = $moduleName;
        $html = <<<EOD
<?php 

namespace App\Http\Controllers\Backend\###MODULE-NAME###;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Repositories\###MODULE-NAME###\Eloquent###MODULE-NAME###Repository;

/**
 * Class Admin###MODULE-NAME###Controller
 */
class Admin###MODULE-NAME###Controller extends Controller
{
    /**
     * ###MODULE-NAME### Repository
     *
     * @var object
     */
    public ##$##repository;

    /**
     * Create Success Message
     *
     * @var string
     */
    protected ##$##createSuccessMessage = "###MODULE-NAME### Created Successfully!";

    /**
     * Edit Success Message
     *
     * @var string
     */
    protected ##$##editSuccessMessage = "###MODULE-NAME### Edited Successfully!";

    /**
     * Delete Success Message
     *
     * @var string
     */
    protected ##$##deleteSuccessMessage = "###MODULE-NAME### Deleted Successfully";

    /**
     * __construct
     *
     */
    public function __construct()
    {
        ##$##this->repository = new Eloquent###MODULE-NAME###Repository;
    }

    /**
     * ###MODULE-NAME### Listing
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view(##$##this->repository->setAdmin(true)->getModuleView('listView'))->with([
            'repository' => ##$##this->repository
        ]);
    }

    /**
     * ###MODULE-NAME### View
     *
     * @return \Illuminate\View\View
     */
    public function create(Request ##$##request)
    {
        return view(##$##this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository' => ##$##this->repository
        ]);
    }

    /**
     * ###MODULE-NAME### Store
     *
     * @return \Illuminate\View\View
     */
    public function store(Request ##$##request)
    {
        ##$##this->repository->create(##$##request->all());

        return redirect()->route(##$##this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess(##$##this->createSuccessMessage);
    }

    /**
     * ###MODULE-NAME### Edit
     *
     * @return \Illuminate\View\View
     */
    public function edit(##$##id, Request ##$##request)
    {
        ##$##item = ##$##this->repository->findOrThrowException(##$##id);

        return view(##$##this->repository->setAdmin(true)->getModuleView('editView'))->with([
            'item'          => ##$##item,
            'repository'    => ##$##this->repository
        ]);
    }

    /**
     * ###MODULE-NAME### Show
     *
     * @return \Illuminate\View\View
     */
    public function show(##$##id, Request ##$##request)
    {
        ##$##item = ##$##this->repository->findOrThrowException(##$##id);

        return view(##$##this->repository->setAdmin(true)->getModuleView('editView'))->with([
            'item'          => ##$##item,
            'repository'    => ##$##this->repository
        ]);
    }


    /**
     * ###MODULE-NAME### Update
     *
     * @return \Illuminate\View\View
     */
    public function update(##$##id, Request ##$##request)
    {
        ##$##status = ##$##this->repository->update(##$##id, ##$##request->all());

        return redirect()->route(##$##this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess(##$##this->editSuccessMessage);
    }

    /**
     * ###MODULE-NAME### Destroy
     *
     * @return \Illuminate\View\View
     */
    public function destroy(##$##id)
    {
        ##$##status = ##$##this->repository->destroy(##$##id);

        return redirect()->route(##$##this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess(##$##this->deleteSuccessMessage);
    }

    /**
     * Get Table Data
     *
     * @return json|mixed
     */
    public function getTableData()
    {
        return Datatables::of(##$##this->repository->getForDataTable())
            ->escapeColumns(['id', 'sort'])
            ->addColumn('actions', function (##$##item) {
                return ##$##item->admin_action_buttons;
            })
            ->make(true);
    }
}
EOD;
        $html = str_replace('##$##', '$', $html);

        return str_replace($keyword, $change, $html);
    }

    public function getEloquentTemplate($moduleName = null)
    {
        $moduleName = isset($moduleName) ? $moduleName : $this->moduleName;
        $tableName = isset($tableName) ? $tableName : $this->tableName;
        $moduleRoutePrefix = strtolower($moduleName);
        $keyword = '###MODULE-NAME###';
        $gridColumns = '###GRID-COLUMNS###';
        $gridHeaders = '###GRID-HEADERS###';
        $change = $moduleName;


        // Check Table Schema
        $moduleConfig = $this->getTableColumns($this->moduleName);

        if(isset($moduleConfig) && !empty($moduleConfig) && isset($moduleConfig->id))
        {
            $columns = $moduleConfig->table_fields;
            $gridColumns = '';
            $gridHeaders = '';
            foreach ($columns as $column) {
                $gridHeaders .= "\t\t'" . $column->field_name . "'        => '" . ucwords($column->field_name) . "',\n";
                $gridColumns .= "'" . $column->field_name . "' =>   [
                    'data'          => '" . $column->field_name . "',
                    'name'          => '" . $column->field_name . "',
                    'searchable'    => true,
                    'sortable'      => true
                ],\n\t\t";
            }

            $gridHeaders .= '"actions"         => "Actions"';
            $gridColumns .= "'actions' => [
                'data'          => 'actions',
                'name'          => 'actions',
                'searchable'    => false,
                'sortable'      => false
            ]";
        }
        else
        {
            $columns = Schema::getColumnListing($tableName);
            $gridColumns = '';
            $gridHeaders = '';
            foreach ($columns as $column) {
                $gridHeaders .= "'" . $column . "'        => '" . ucwords($column) . "',\n";
                $gridColumns .= "'" . $column . "' =>   [
                    'data'          => '" . $column . "',
                    'name'          => '" . $column . "',
                    'searchable'    => true,
                    'sortable'      => true
                ],\n\t\t";
            }

            $gridHeaders .= '"actions"         => "Actions"';
            $gridColumns .= "'actions' => [
                'data'          => 'actions',
                'name'          => 'actions',
                'searchable'    => false,
                'sortable'      => false
            ]";
        }
        
        $html = <<<EOD
<?php 

namespace App\Repositories\###MODULE-NAME###;

/**
 * Class Eloquent###MODULE-NAME###Repository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\###MODULE-NAME###\###MODULE-NAME###;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class Eloquent###MODULE-NAME###Repository extends DbRepository
{
    /**
     * ###MODULE-NAME### Model
     *
     * @var Object
     */
    public ##$##model;

    /**
     * ###MODULE-NAME### Title
     *
     * @var string
     */
    public ##$##moduleTitle = '###MODULE-NAME###';

    /**
     * Table Headers
     *
     * @var array
     */
    public ##$##tableHeaders = [
        ###GRID-HEADERS###
    ];

    /**
     * Table Columns
     *
     * @var array
     */
    public ##$##tableColumns = [
        ###GRID-COLUMNS###
    ];

    /**
     * Is Admin
     *
     * @var boolean
     */
    protected ##$##isAdmin = false;

    /**
     * Admin Route Prefix
     *
     * @var string
     */
    public ##$##adminRoutePrefix = 'admin';

    /**
     * Client Route Prefix
     *
     * @var string
     */
    public ##$##clientRoutePrefix = 'frontend';

    /**
     * Admin View Prefix
     *
     * @var string
     */
    public ##$##adminViewPrefix = 'backend';

    /**
     * Client View Prefix
     *
     * @var string
     */
    public ##$##clientViewPrefix = 'frontend';

    /**
     * Module Routes
     *
     * @var array
     */
    public ##$##moduleRoutes = [
        'listRoute'     => '###LOWER-CASEMODULE-NAME###.index',
        'createRoute'   => '###LOWER-CASEMODULE-NAME###.create',
        'storeRoute'    => '###LOWER-CASEMODULE-NAME###.store',
        'editRoute'     => '###LOWER-CASEMODULE-NAME###.edit',
        'updateRoute'   => '###LOWER-CASEMODULE-NAME###.update',
        'deleteRoute'   => '###LOWER-CASEMODULE-NAME###.destroy',
        'dataRoute'     => '###LOWER-CASEMODULE-NAME###.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public ##$##moduleViews = [
        'listView'      => '###LOWER-CASEMODULE-NAME###.index',
        'createView'    => '###LOWER-CASEMODULE-NAME###.create',
        'editView'      => '###LOWER-CASEMODULE-NAME###.edit',
        'deleteView'    => '###LOWER-CASEMODULE-NAME###.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        ##$##this->model = new ###MODULE-NAME###;
    }

    /**
     * Create ###MODULE-NAME###
     *
     * @param array ##$##input
     * @return mixed
     */
    public function create(##$##input)
    {
        ##$##input = ##$##this->prepareInputData(##$##input, true);
        ##$##model = ##$##this->model->create(##$##input);

        if(##$##model)
        {
            return ##$##model;
        }

        return false;
    }

    /**
     * Update ###MODULE-NAME###
     *
     * @param int ##$##id
     * @param array ##$##input
     * @return bool|int|mixed
     */
    public function update(##$##id, ##$##input)
    {
        ##$##model = ##$##this->model->find(##$##id);

        if(##$##model)
        {
            ##$##input = ##$##this->prepareInputData(##$##input);

            return ##$##model->update(##$##input);
        }

        return false;
    }

    /**
     * Destroy ###MODULE-NAME###
     *
     * @param int ##$##id
     * @return mixed
     * @throws GeneralException
     */
    public function destroy(##$##id)
    {
        ##$##model = ##$##this->model->find(##$##id);

        if(##$##model)
        {
            return ##$##model->delete();
        }

        return  false;
    }

    /**
     * Get All
     *
     * @param string ##$##orderBy
     * @param string ##$##sort
     * @return mixed
     */
    public function getAll(##$##orderBy = 'id', ##$##sort = 'asc')
    {
        return ##$##this->model->orderBy(##$##orderBy, ##$##sort)->get();
    }

    /**
     * Get by Id
     *
     * @param int ##$##id
     * @return mixed
     */
    public function getById(##$##id = null)
    {
        if(##$##id)
        {
            return ##$##this->model->find(##$##id);
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
            ##$##this->model->getTable().'.*'
        ];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return ##$##this->model->select(##$##this->getTableFields())->get();
    }

    /**
     * Set Admin
     *
     * @param boolean ##$##isAdmin [description]
     */
    public function setAdmin(##$##isAdmin = false)
    {
        ##$##this->isAdmin = ##$##isAdmin;

        return ##$##this;
    }

    /**
     * Prepare Input Data
     *
     * @param array ##$##input
     * @param bool ##$##isCreate
     * @return array
     */
    public function prepareInputData(##$##input = array(), ##$##isCreate = false)
    {
        if(##$##isCreate)
        {
            ##$##input = array_merge(##$##input, ['user_id' => access()->user()->id]);
        }

        return ##$##input;
    }

    /**
     * Get Table Headers
     *
     * @return string
     */
    public function getTableHeaders()
    {
        if(##$##this->isAdmin)
        {
            return json_encode(##$##this->setTableStructure(##$##this->tableHeaders));
        }

        ##$##clientHeaders = ##$##this->tableHeaders;

        unset(##$##clientHeaders['username']);

        return json_encode(##$##this->setTableStructure(##$##clientHeaders));
    }

    /**
     * Get Table Columns
     *
     * @return string
     */
    public function getTableColumns()
    {
        if(##$##this->isAdmin)
        {
            return json_encode(##$##this->setTableStructure(##$##this->tableColumns));
        }

        ##$##clientColumns = ##$##this->tableColumns;

        unset(##$##clientColumns['username']);

        return json_encode(##$##this->setTableStructure(##$##clientColumns));
    }
}
EOD;
        $html = str_replace('###LOWER-CASEMODULE-NAME###', strtolower($moduleName), $html);
        $html = str_replace('###GRID-HEADERS###', $gridHeaders, $html);
        $html = str_replace('###GRID-COLUMNS###', $gridColumns, $html);
        $html = str_replace('##$##', '$', $html);

        return str_replace($keyword, $change, $html);
    }

    /**
     * Get Migration Template
     * 
     * @param Object $inputTable
     * @param collection $inputFields
     */
    public function getMigrationTemplate($inputTable, $inputFields)
    {
        $html = <<<EOD
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create###Tablename###Fields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('###tablename###', function (Blueprint ##$##table) {
EOD;
        $html .= "\n\t\t\t";
        foreach ($inputFields as $inputF) {
            $html = $html . $this->getInputTemplate($inputF) . " \n\t\t\t";
        }

        $html = $html .  <<<EOD
##$##table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('###tablename###');
    }
}
EOD;
        $html = str_replace('###Tablename###', ucfirst($inputTable->title), $html);
        $html = str_replace('###tablename###', $inputTable->title, $html);
        $html = str_replace('##$##', '$', $html);
        return $html;
    }

    /**
     * Generate Migration File
     * 
     * @param Object $table
     * @param Collection $tableFields
     * @return bool
     */
    public function generateMigrationFile($table, $tableFields)
    {
        $migrationPath = 'database/migrations';
        $migratePath = base_path() . DIRECTORY_SEPARATOR . $migrationPath;
        $fileName = "auto_" . date("Y_m_d_his") . '_' . $table->notes . '.php';
        $file = $migratePath . DIRECTORY_SEPARATOR . $fileName;
        $content = $this->getMigrationTemplate($table, $tableFields);

        if (!is_writable($migratePath)) {
            // Change Folder Permission
            //chmod($migratePath, 0755);
            exec('sudo chmod ' . $migratePath . ' 777');
        }

        $status = File::put($file, $content);

        if ($status) {
            //chmod($file, 0777);
            exec('sudo chmod ' . $file . ' 777');

            return true;
        }

        return false;
    }

    /**
     * Get Input Template
     * 
     * @param Object $input
     * @return string
     */
    public function getInputTemplate($input)
    {
        if ($input->is_primary_field === 1) {
            return "\t##$##table->bigIncrements('" . $input->field_name . "');";
        }

        $isNullable = '';
        $isIndex    = '';
        $isUnique   = '';
        $isDefault  = '';
        $isSoftDelete = '';

        if ($input->is_nullable == 1) {
            $isNullable = '->nullable()';
        }

        if ($input->is_index_field == 1) {
            $isIndex = '->index()';
        }

        if ($input->is_unique_field == 1) {
            $isUnique = '->unique()';
        }

        if ($input->is_soft_delete == 1) {
            $isSoftDelete = '->nullable()->default(null)';
        }

        $postString = $isNullable . $isIndex . $isUnique . $isDefault;

        if (
            $input->is_soft_delete == 0
            &&
            isset($input->default_value)
            &&
            !empty($input->default_value)
        ) {
            $isDefault = '->default("' . $input->default_value . '")';
        }

        switch ($input->field_type) {
            case 'int':
                return "##$##table->integer('" . $input->field_name . "')" . $postString . ";";

            case 'float':
                return "##$##table->float('" . $input->field_name . "', 10 , 3)" . $postString . ";";

            case 'date':
                return "##$##table->date('" . $input->field_name . "')" . $postString . ";";

            case 'longText':
                return "##$##table->longText('" . $input->field_name . "')" . $postString . ";";

            case 'string':
                return "##$##table->string('" . $input->field_name . "')" . $postString . ";";

            case 'timestamp':
                return "##$##table->timestamp('" . $input->field_name . "')" . $postString . ";";

            case 'datetime':
                return "##$##table->datetime('" . $input->field_name . "')" . $postString . ";";

            default:
                return "##$##table->string('" . $input->field_name . "')" . $postString . ";";
                break;
        }
    }
}