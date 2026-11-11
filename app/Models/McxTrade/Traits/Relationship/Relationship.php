<?php 

namespace App\Models\McxTrade\Traits\Relationship;

use App\Models\ClientDetail\ClientDetail;

trait Relationship
{
	/**
	 * belongsTo
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function clientInfo()
	{
	    return $this->belongsTo(ClientDetail::class, 'client_id');
	}
}