<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class TransactionsTransformer extends Transformer
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
			"master_account_id" => (int) $item->master_account_id,
			"client_id" => (int) $item->client_id,
			"debit" => (float) $item->debit,
			"credit" => (float) $item->credit,
			"amount" => (float) $item->amount,
			"notes" => (string) $item->notes,
			"transaction_date" => (string) $item->transaction_date,
			"created_by" => (int) $item->created_by,
			
        ];
    }
}