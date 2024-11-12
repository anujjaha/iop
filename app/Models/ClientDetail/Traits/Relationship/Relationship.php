<?php 

namespace App\Models\ClientDetail\Traits\Relationship;

use App\Models\IpoAssignments\IpoAssignments;
use App\Models\Transactions\Transactions;
use App\Models\Stock\Stock;

trait Relationship
{
	/**
     * belongsTo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function assignedIpos()
    {
        return $this->hasMany(IpoAssignments::class, 'client_id');
    }

    /**
     * belongsTo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'client_id')->whereNull('monthly_fee');
    }

    /**
     * belongsTo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function monthlyFees()
    {
        return $this->hasMany(Transactions::class, 'client_id')->whereNotNull('monthly_fee');
    }


    /**
     * belongsTo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stockList()
    {
        return $this->hasMany(Stock::class, 'client_id');
    }
}