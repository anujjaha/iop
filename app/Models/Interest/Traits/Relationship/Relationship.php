<?php 

namespace App\Models\Interest\Traits\Relationship;

use App\Models\ClientDetail\ClientDetail;

trait Relationship
{
	/**
     * BelongsTO
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->belongsTo(ClientDetail::class, 'client_id');
    }
}