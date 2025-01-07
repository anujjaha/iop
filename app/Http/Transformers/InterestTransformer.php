<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class InterestTransformer extends Transformer
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
			"credit_date" => (date) $item->credit_date,
			
        ];
    }
}