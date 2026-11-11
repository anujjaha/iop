<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class McxTradeTransformer extends Transformer
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
			"mcx_code" => (string) $item->mcx_code,
			"qty" => (int) $item->qty,
			"buy_price" => (int) $item->buy_price,
			"sell_price" => (int) $item->sell_price,
			"additional_bcost" => (int) $item->additional_bcost,
			"additional_scost" => (int) $item->additional_scost,
			"additional_total" => (int) $item->additional_total,
			"trade_type" => (string) $item->trade_type,
			"trade_date" => (date) $item->trade_date,
			"settle_date" => (date) $item->settle_date,
			"profit_loss" => (int) $item->profit_loss,
			"net_profit_loss" => (int) $item->net_profit_loss,
			"is_settle" => (int) $item->is_settle,
			"tmonth" => (string) $item->tmonth,
			
        ];
    }
}