<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class AllFdListTransformer extends Transformer
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
			"fd_ref_no" => (string) $item->fd_ref_no,
			"amount" => (float) $item->amount,
			"start_date" => (date) $item->start_date,
			"end_date" => (date) $item->end_date,
			"rate_of_int" => (float) $item->rate_of_int,
			"expected_monthly_int" => (float) $item->expected_monthly_int,
			"bank_name" => (string) $item->bank_name,
			"payout_type" => (string) $item->payout_type,
			"title" => (string) $item->title,
			"notes" => (longText) $item->notes,
			
        ];
    }
}