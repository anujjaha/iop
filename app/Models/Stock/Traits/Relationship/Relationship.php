<?php 

namespace App\Models\Stock\Traits\Relationship;

use App\Models\ClientDetail\ClientDetail;

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
}