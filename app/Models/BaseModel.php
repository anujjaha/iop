<?php

namespace App\Models;

/*
 * Class BaseModel
 *
 * @author Anuj Jaha er.anujjaha@gmail.com
 */

use Schema;
use ReflectionClass;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\RelationNotFoundException;

class BaseModel extends Model
{
    /**
     * Casts.
     *
     * @var array
     */
    protected $casts = ['id' => 'string'];

    public static function create(array $attributes = [])
    {
        // $user = access()->user();

        // if ($user) {
        //     $attributes['user_id'] = (! isset($attributes['user_id']) ? $user->id : $attributes['user_id']);
        // }

        // $childClass = get_called_class();
        // $model = new $childClass;
        // $model->runActionLogger(false, 'create');

        return parent::query()->create($attributes);
    }

    /*public static function create(array $attributes = Array())
    {
        return parent::query()->create($attributes);
    }*/

    /**
     * Update the model in the database.
     *
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = [])
    {
        //$this->runActionLogger($this, 'update');

        return parent::update($attributes);
    }

    /**
     * Delete the model in the database.
     *
     * @return bool
     */
    public function delete()
    {
        return parent::delete();
    }

    /**
     * Get Data With Account Filter.
     *
     * @param $account
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function getAll($account = false)
    {
        return parent::get();
    }
    
    /**
     * Run Action Logger.
     *
     * @param $model
     * @param $action
     */
    public function runActionLogger($model, $action)
    {
        $modelClass = (new \ReflectionClass($this))->getShortName();
        $model = $model ? $model : $this;
        $user = access()->user();

        $notAllowed = [
        ];

        if ($user && isset($model->id)) {
            $actionLogger = new UpdateLogger();

            $data = [
                'user_id'       => $user->id,
                'section'       => $modelClass,
                'action'        => $action,
                'item'          => $model->getOriginal('id'),
            ];

            $actionLogger->create($data);
        }
    }

    /**
     * Get Action Logs.
     *
     * @param bool $model
     * @param bool $item
     * @param int $limit
     * @return mixed
     */
    public function getActionLogs($model = false, $item = true, $limit = 10)
    {
        $actionLogger = new UpdateLogger();
        $model = $model ? $model : $this;

        if ($item) {
            return $actionLogger->getActionLogs($model, $model->getOriginal('id'), $limit);
        } else {
            return $actionLogger->getActionLogs($model, false, $limit);
        }
    }
}
