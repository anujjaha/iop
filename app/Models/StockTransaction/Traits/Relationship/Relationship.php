<?php 

namespace App\Models\StockTransaction\Traits\Relationship;

use App\Models\ClientDetail\ClientDetail;
use App\Models\Stock\Stock;


trait Relationship
{
	/**
     * belongsTo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->belongsTo(ClientDetail::class);
    }

    /**
     * belongsTo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}