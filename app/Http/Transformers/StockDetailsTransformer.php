<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class StockDetailsTransformer extends Transformer
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
			"code" => (string) $item->code,
			"title" => (string) $item->title,
			"external_link" => (string) $item->external_link,
			"cmp" => (float) $item->cmp,
			"cmp_at" => (datetime) $item->cmp_at,
			"notes" => (longText) $item->notes,
			"is_nse" => (int) $item->is_nse,
			
        ];
    }
}