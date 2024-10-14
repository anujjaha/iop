<?php 

namespace App\Models\IpoAssignments\Traits\Relationship;

use App\Models\ClientDetail\ClientDetail;
use App\Models\IpoDetails\IpoDetails;

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
    public function ipo()
    {
        return $this->belongsTo(IpoDetails::class);
    }
}