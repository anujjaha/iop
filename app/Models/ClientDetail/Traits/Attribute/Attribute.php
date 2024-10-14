<?php 

namespace App\Models\ClientDetail\Traits\Attribute;

/**
 * Trait Attribute
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com )
 */

use App\Repositories\ClientDetail\EloquentClientDetailRepository;

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

    /**
     * @return string
     */
    public function getAddFundButtonAttribute($routes, $prefix = 'admin', $isAdmin = false)
    {
        $id = $isAdmin ? $this->id : hasher()->encode($this->id);

        return '<a href="'.route('admin.transactions.create').'" class="btn btn-xs btn-primary"><i class="fa fa-money-bill" data-toggle="tooltip" data-placement="top" title="Fund"></i></a> ';
    }

    /**
     * @return string
     */
    public function getViewButtonAttribute($routes, $prefix = 'admin', $isAdmin = false)
    {
        $id = $isAdmin ? $this->id : hasher()->encode($this->id);

        return '<a href="'.route($prefix .'.'. $routes->showRoute, $id).'" class="btn btn-xs btn-primary"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a> ';
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
        $repository = new EloquentClientDetailRepository;
        $routes     = $repository->getModuleRoutes();

        return $this->getEditButtonAttribute($routes, $repository->clientRoutePrefix) . $this->getDeleteButtonAttribute($routes, $repository->clientRoutePrefix);
    }

    /**
     * @return string
     */
    public function getAdminActionButtonsAttribute()
    {
        $repository = new EloquentClientDetailRepository;
        $routes     = $repository->getModuleRoutes();

        return $this->getViewButtonAttribute($routes, $repository->adminRoutePrefix, true) .
                $this->getEditButtonAttribute($routes, $repository->adminRoutePrefix, true) .
                //$this->getAddFundButtonAttribute($routes, $repository->adminRoutePrefix, true) .
                $this->getDeleteButtonAttribute($routes, $repository->adminRoutePrefix);
    }
}