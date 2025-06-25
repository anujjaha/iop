<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class ClientStockTransactionTransformer extends Transformer
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
			"buy_cost" => (float) $item->buy_cost,
			"buy_qty" => (int) $item->buy_qty,
			"buy_date" => (date) $item->buy_date,
			"sell_cost" => (float) $item->sell_cost,
			"sell_qty" => (int) $item->sell_qty,
			"sell_date" => (date) $item->sell_date,
			"total_transaction_value" => (float) $item->total_transaction_value,
			"tax" => (float) $item->tax,
			"brokerage_percentage" => (float) $item->brokerage_percentage,
			"brokerage_cost" => (float) $item->brokerage_cost,
			"net_profit" => (float) $item->net_profit,
			"net_loss" => (float) $item->net_loss,
			"is_profit" => (int) $item->is_profit,
			"is_loss" => (int) $item->is_loss,
			"notes" => (longText) $item->notes,
			
        ];
    }
}