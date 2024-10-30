<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class StockTransactionTransformer extends Transformer
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
			"stock_id" => (int) $item->stock_id,
			"client_id" => (int) $item->client_id,
			"buy_price" => (int) $item->buy_price,
			"sell_price" => (int) $item->sell_price,
			"qty" => (int) $item->qty,
			"profit_loss" => (int) $item->profit_loss,
			"notes" => (longText) $item->notes,
			
        ];
    }
}