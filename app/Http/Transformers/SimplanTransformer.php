<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class SimplanTransformer extends Transformer
{
    /**
     * Transform
     *
     * @param array $data
     * @return array
     */
    public function transform($item)
    {
        if(is_array($item))
        {
            $item = (object)$item;
        }

        return [
			"id" => (int) $item->id,
			"sim_id" => (int) $item->sim_id,
			"title" => (string) $item->title,
			"cost" => (int) $item->cost,
			"recharge_date" => (date) $item->recharge_date,
			"expire_date" => (date) $item->expire_date,
			"current_plan" => (string) $item->current_plan,
			
        ];
    }
}