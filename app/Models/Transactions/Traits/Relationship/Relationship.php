<?php 

namespace App\Models\Transactions\Traits\Relationship;

use App\Models\IpoDetails\IpoDetails;
use App\Models\ClientDetail\ClientDetail;


trait Relationship
{
	/**
     * belongsTo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ipo()
    {
        return $this->belongsTo(IpoDetails::class);
    }

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