<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class VisitTransformer extends Transformer
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
			"content_id" => (int) $item->content_id,
			"user_id" => (int) $item->user_id,
			"actionType" => (int) $item->actionType,
			"ip" => (string) $item->ip,
			"user_agent" => (string) $item->user_agent,
			
        ];
    }
}