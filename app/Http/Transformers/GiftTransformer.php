<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class GiftTransformer extends Transformer
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
			"amount" => (int) $item->amount,
			"notes" => (longText) $item->notes,
			"user_id" => (int) $item->user_id,
			
        ];
    }
}