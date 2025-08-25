<?php 

namespace App\Models\Sim\Traits\Attribute;

/**
 * Trait Attribute
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com )
 */

use App\Repositories\Sim\EloquentSimRepository;

trait Attribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute($routes, $prefix = 'admin', $isAdmin = false)
    {
        $id = $isAdmin ? $this->id : hasher()->encode($this->id);

        return '<a href="'.route($prefix .'.'. $routes->editRoute, $id).'" class="btn btn-xs btn-primary"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> ';
    }

    public function getSimButtonAttribute($routes, $prefix = 'admin', $isAdmin = false)
    {
        $id = $isAdmin ? $this->id : hasher()->encode($this->id);

        return '<a data-id="'.$id.'" onclick="attachPlan('.$id.')" href="javascript:void(0)" class="btn btn-xs btn-primary"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="Plan"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute($routes, $prefix = 'admin')
    {
        return '<a href="'.route($prefix .'.'. $routes->deleteRoute, $this).'"
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
        $repository = new EloquentSimRepository;
        $routes     = $repository->getModuleRoutes();

        return $this->getEditButtonAttribute($routes, $repository->clientRoutePrefix) . $this->getDeleteButtonAttribute($routes, $repository->clientRoutePrefix);
    }

    /**
     * @return string
     */
    public function getAdminActionButtonsAttribute()
    {
        $repository = new EloquentSimRepository;
        $routes     = $repository->getModuleRoutes();

        return $this->getSimButtonAttribute($routes, $repository->adminRoutePrefix, true).$this->getEditButtonAttribute($routes, $repository->adminRoutePrefix, true) . $this->getDeleteButtonAttribute($routes, $repository->adminRoutePrefix);
    }
}