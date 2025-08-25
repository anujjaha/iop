<?php 

namespace App\Models\Sim\Traits\Relationship;

use App\Models\Mobile\Mobile;
use App\Models\Simplan\Simplan;

trait Relationship
{
	public function attachedDevice()
    {
        return $this->belongsTo(Mobile::class, 'device_id');
    }

    public function attachedPlan()
    {
        return $this->belongsTo(Simplan::class, 'plan_id');
    }
}