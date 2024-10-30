<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class TaxTransformer extends Transformer
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
			"total_amount" => (int) $item->total_amount,
			"tax_amount" => (int) $item->tax_amount,
			"profit_amount" => (int) $item->profit_amount,
			"notes" => (longText) $item->notes,
			
        ];
    }
}