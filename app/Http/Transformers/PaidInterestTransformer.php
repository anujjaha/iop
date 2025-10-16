<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class PaidInterestTransformer extends Transformer
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
			"title" => (string) $item->title,
			"amount" => (float) $item->amount,
			"pay_mode" => (int) $item->pay_mode,
			"notes" => (longText) $item->notes,
			
        ];
    }
}