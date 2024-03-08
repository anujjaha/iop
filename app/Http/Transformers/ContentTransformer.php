<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class ContentTransformer extends Transformer
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
			"category_id" => (int) $item->category_id,
			"temp_id" => (int) $item->temp_id,
			"slug" => (string) $item->slug,
			"company_name" => (string) $item->company_name,
			"owner_1" => (string) $item->owner_1,
			"owner_2" => (string) $item->owner_2,
			"contact_primary" => (string) $item->contact_primary,
			"contact_secondary" => (string) $item->contact_secondary,
			"email" => (string) $item->email,
			"website" => (string) $item->website,
			"address" => (string) $item->address,
			"city" => (string) $item->city,
			"state" => (string) $item->state,
			"pincode" => (string) $item->pincode,
			"logo" => (string) $item->logo,
			"image" => (string) $item->image,
			"file_pdf" => (string) $item->file_pdf,
			"qr_1" => (string) $item->qr_1,
			"qr_2" => (string) $item->qr_2,
			"qr_3" => (string) $item->qr_3,
			"created_by" => (int) $item->created_by,
			"status" => (int) $item->status,
			"created_at" => (string) $item->created_at,
			"updated_at" => (string) $item->updated_at,
			"deleted_at" => (string) $item->deleted_at,
			
        ];
    }
}