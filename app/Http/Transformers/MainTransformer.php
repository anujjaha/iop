<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class MainTransformer extends Transformer
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
			"name" => (string) $item->name,
			"bank" => (string) $item->bank,
			"branch" => (string) $item->branch,
			"account_number" => (string) $item->account_number,
			"ifsc" => (string) $item->ifsc,
			"balance" => (float) $item->balance,
			"notes" => (string) $item->notes,
			
        ];
    }
}