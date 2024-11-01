<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class ExpenseTransformer extends Transformer
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
			"user_id" => (int) $item->user_id,
			"category" => (string) $item->category,
			"title" => (string) $item->title,
			"amount" => (int) $item->amount,
			"notes" => (longText) $item->notes,
			"created_by" => (int) $item->created_by,
			
        ];
    }
}