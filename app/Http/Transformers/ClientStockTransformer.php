<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class ClientStockTransformer extends Transformer
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
			"stock_id" => (int) $item->stock_id,
			"buy_qty" => (int) $item->buy_qty,
			"buy_cost" => (float) $item->buy_cost,
			"buy_date" => (int) $item->buy_date,
			"notes" => (longText) $item->notes,
			
        ];
    }
}