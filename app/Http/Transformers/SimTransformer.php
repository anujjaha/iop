<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class SimTransformer extends Transformer
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
			"device_id" => (int) $item->device_id,
			"plan_id" => (int) $item->plan_id,
			"company" => (string) $item->company,
			"mobile_number" => (string) $item->mobile_number,
			"cost" => (int) $item->cost,
			"purchase_date" => (int) $item->purchase_date,
			"status" => (int) $item->status,
			"notes" => (longText) $item->notes,
			
        ];
    }
}