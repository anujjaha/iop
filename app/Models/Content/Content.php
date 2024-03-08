<?php 

namespace App\Models\Content;

/**
 * Class Content
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Content\Traits\Attribute\Attribute;
use App\Models\Content\Traits\Relationship\Relationship;

class Content extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "contents";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "user_id", "account_id", "category_id", "temp_id", "slug", "company_name", "owner_1", "owner_2", "contact_primary", "contact_secondary", "email", "website", "address", "city", "state", "pincode", "google_map", "logo", "image", "file_pdf", "qr_1", "qr_2", "qr_3", "created_by", "status", "created_at", "updated_at", "deleted_at", 
    ];

    /**
     * Timestamp flag
     *
     */
    public $timestamps = true;

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}