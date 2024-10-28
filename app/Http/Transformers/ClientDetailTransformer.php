<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class ClientDetailTransformer extends Transformer
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
			"birthdate" => (string) $item->birthdate,
			"mobile" => (string) $item->mobile,
			"email" => (string) $item->email,
			"aadhar_no" => (string) $item->aadhar_no,
			"pan_no" => (string) $item->pan_no,
			"dmat_co_name" => (string) $item->dmat_co_name,
			"dmat_account" => (string) $item->dmat_account,
			"bank_name" => (string) $item->bank_name,
			"bank_account" => (string) $item->bank_account,
			"bank_branch" => (string) $item->bank_branch,
			"ifsc_code" => (string) $item->ifsc_code,
			"balance" => (float) $item->balance,
			"profit_loss" => (float) $item->profit_loss,
			"address" => (string) $item->address,
			"dmat_user_name" => (string) $item->dmat_user_name,
			"dmat_password" => (string) $item->dmat_password,
			"is_huf" => (int) $item->is_huf,
			"status" => (int) $item->status,
			"start_date" => (string) $item->start_date,
			
        ];
    }
}