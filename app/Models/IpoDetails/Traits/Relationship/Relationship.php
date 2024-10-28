<?php 

namespace App\Models\IpoDetails\Traits\Relationship;

use App\Models\IpoAssignments\IpoAssignments;

trait Relationship
{
	/**
     * hasMany
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function assignments()
    {
        return $this->hasMany(IpoAssignments::class, 'ipo_id');
    }
}