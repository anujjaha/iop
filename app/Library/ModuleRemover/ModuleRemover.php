<?php

namespace App\Library\ModuleRemover;

use File;
use Schema;
use Artisan;

/**
 * Class Module Generator.
 *
 * @author Anuj Jaha
 */
class ModuleRemover
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
    
    public function __construct()
    {
    }
    
    public function run($module = null)
    {
        $this->moduleName = ucfirst($module->module_name);
        
        $this->removeMigrationFile();
        $this->removeAPIFiles();
        $this->removeModuleController();
        $this->removeModuleTransformer();
        $this->removeModuleModel();
        $this->removeModuleRepository();
        $this->removeModuleViews();
        $this->removeModuleRoutes();
    }

    /**
     * Remove API Files
     */
    protected function removeAPIFiles()
    {
        $fileName = 'API' . $this->moduleName . 'Controller.php';
        
        return $this->forceRemoveFile(base_path() . DIRECTORY_SEPARATOR . $this->apiControllerPath . DIRECTORY_SEPARATOR . $fileName);
    }

    /**
     * Remove Module Controller
     */
    protected function removeModuleController()
    {
        $dirPath = base_path() . DIRECTORY_SEPARATOR . $this->controllerPath . DIRECTORY_SEPARATOR . $this->moduleName;
        
        return $this->forceRemoveDir($dirPath);
    }

    /**
     * Remove Module Transformer
     * 
     * @return bool
     */
    protected function removeModuleTransformer()
    {
        $basePath = base_path() . DIRECTORY_SEPARATOR . $this->apiTransformPath;
        $fileName = $this->moduleName . 'Transformer.php';
        
        return $this->forceRemoveFile($basePath . DIRECTORY_SEPARATOR . $fileName);
    }

    /**
     * Remove Module Model
     * 
     * @return bool
     */
    protected function removeModuleModel()
    {
        $dirPath = base_path() . DIRECTORY_SEPARATOR . $this->modelPath . DIRECTORY_SEPARATOR . $this->moduleName;
        
        return $this->forceRemoveDir($dirPath);
    }

    /**
     * Remove Module Repository
     * 
     * @return bool
     */
    protected function removeModuleRepository()
    {
        $dirPath = base_path() . DIRECTORY_SEPARATOR . $this->eloquentPath . DIRECTORY_SEPARATOR . $this->moduleName;
        
        return $this->forceRemoveDir($dirPath);
    }

    /**
     * Remove Module Views
     * 
     * @return bool
     */
    protected function removeModuleViews()
    {
        $viewPath = base_path() . DIRECTORY_SEPARATOR . $this->viewPath;
        $backendPath = $viewPath . DIRECTORY_SEPARATOR . 'backend';
        $commonPath = $viewPath . DIRECTORY_SEPARATOR . 'common';

        $this->forceRemoveDir($backendPath);
        $this->forceRemoveDir($commonPath);
        
        return true;
    }

    /**
     * Remove Module Routes
     * 
     * @return bool
     */
    protected function removeModuleRoutes()
    {
        $basePath       = base_path() . DIRECTORY_SEPARATOR . $this->apiRoutePath;
        $fileName       = $this->moduleName . '.php';
        $apiRoutefile   = $basePath . DIRECTORY_SEPARATOR . $fileName;
        
        
        $this->forceRemoveFile($apiRoutefile);

        $routePath  = base_path() . DIRECTORY_SEPARATOR . $this->routePath;
        $fileName   = $this->moduleName . '.php';
        $routeFile  = $routePath . DIRECTORY_SEPARATOR . $fileName;

        $this->forceRemoveFile($routeFile);
        
        return true;
    }

    protected function forceRemoveDir($path = null)
    {
        if(isset($path) && !empty($path) && is_dir($path))
        {
            \File::deleteDirectory($path);
        }
        
        return true;
    }

    protected function forceRemoveFile($path = null)
    {
        if(isset($path) && !empty($path) && file_exists($path))
        {
            \File::delete($path);
        }
        
        return true;
    }

    protected function removeMigrationFile()
    {
        return true;
    }
}