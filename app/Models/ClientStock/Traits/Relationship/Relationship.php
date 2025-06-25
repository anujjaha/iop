<?php 

namespace App\Models\ClientStock\Traits\Relationship;

use App\Models\StockDetails\StockDetails;

trait Relationship
{
	/**
     * belongsTo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stockDetail()
    {
        return $this->belongsTo(StockDetails::class, 'stock_id');
    }
}