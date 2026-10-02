<?php 

namespace App\Models\AllFdList\Traits\Relationship;


use App\Models\ClientDetail\ClientDetail;
use App\Models\User\User;

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