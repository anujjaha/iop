<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class MobileTransformer extends Transformer
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
			"title" => (string) $item->title,
			"company" => (string) $item->company,
			"cost" => (int) $item->cost,
			"purchase_date" => (date) $item->purchase_date,
			"notes" => (longText) $item->notes,
			"is_smart" => (int) $item->is_smart,
			"status" => (int) $item->status,
			
        ];
    }
}