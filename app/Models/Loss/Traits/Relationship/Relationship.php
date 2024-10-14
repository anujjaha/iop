<?php 

namespace App\Models\Loss\Traits\Relationship;

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