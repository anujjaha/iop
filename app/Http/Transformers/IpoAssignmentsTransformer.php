<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class IpoAssignmentsTransformer extends Transformer
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
			"ipo_id" => (int) $item->ipo_id,
			"status" => (int) $item->status,
			"profit_loss" => (float) $item->profit_loss,
			"applied_date" => (string) $item->applied_date,
			"revoked_date" => (string) $item->revoked_date,
			"alloted_date" => (string) $item->alloted_date,
			"refund_date" => (string) $item->refund_date,
			"opening_rate" => (float) $item->opening_rate,
			"sell_price" => (float) $item->sell_price,
			"sell_date" => (string) $item->sell_date,
			"return_date" => (string) $item->return_date,
			"notes" => (string) $item->notes,
			
        ];
    }
}