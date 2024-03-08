<?php 

namespace App\Models\Content\Traits\Relationship;

use App\Models\Visit\Visit;

trait Relationship
{
	public function visits()
	{
		return $this->hasMany(Visit::class);
	}

	public function visitCounter()
	{
		return $this->hasMany(Visit::class)->count();
	}
}