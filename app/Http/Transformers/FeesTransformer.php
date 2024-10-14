<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class FeesTransformer extends Transformer
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
			"client_id" => (int) $item->client_id,
			"month_title" => (string) $item->month_title,
			"fee_amount" => (int) $item->fee_amount,
			"notes" => (longText) $item->notes,
			
        ];
    }
}