<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class ProfitTransformer extends Transformer
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
			"profit_amount" => (int) $item->profit_amount,
			"notes" => (longText) $item->notes,
			"executed_on" => (datetime) $item->executed_on,
			
        ];
    }
}