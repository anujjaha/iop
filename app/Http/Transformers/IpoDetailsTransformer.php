<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class IpoDetailsTransformer extends Transformer
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
			"ipo_name" => (string) $item->ipo_name,
			"opening_date" => (string) $item->opening_date,
			"closing_date" => (string) $item->closing_date,
			"listing_date" => (string) $item->listing_date,
			"gmp_latest" => (float) $item->gmp_latest,
			"lot_size" => (int) $item->lot_size,
			"block_amt" => (float) $item->block_amt,
			"refund_date" => (string) $item->refund_date,
			"listed_price" => (float) $item->listed_price,
			"ipo_type" => (string) $item->ipo_type,
			"notes" => (string) $item->notes,
			
        ];
    }
}