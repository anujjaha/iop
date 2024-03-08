<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class GeneralTransformer extends Transformer
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
			"account_id" => (int) $item->account_id,
			"title" => (string) $item->title,
			"name" => (string) $item->name,
			"primary_contact" => (string) $item->primary_contact,
			"email" => (string) $item->email,
			"address" => (string) $item->address,
			"city" => (string) $item->city,
			"state" => (string) $item->state,
			"pincode" => (string) $item->pincode,
			"website" => (string) $item->website,
			"gmap" => (longText) $item->gmap,
			"notes" => (longText) $item->notes,
			"status" => (int) $item->status,
			"web_qr" => (string) $item->web_qr,
			"email_qr" => (string) $item->email_qr,
			"gmap_qr" => (string) $item->gmap_qr,
			
        ];
    }
}