<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class LossTransformer extends Transformer
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
			"loss_amount" => (float) $item->loss_amount,
			"notes" => (longText) $item->notes,
			"executed_on" => (date) $item->executed_on,
			
        ];
    }
}