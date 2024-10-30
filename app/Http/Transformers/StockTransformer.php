<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class StockTransformer extends Transformer
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
			"title" => (string) $item->title,
			"code" => (string) $item->code,
			"cost" => (int) $item->cost,
			"qty" => (int) $item->qty,
			"cmp" => (int) $item->cmp,
			"external_link" => (string) $item->external_link,
			"notes" => (longText) $item->notes,
			
        ];
    }
}