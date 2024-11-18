<?php 

namespace App\Models\DigiDocuments;

/**
 * Class DigiDocuments
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\DigiDocuments\Traits\Attribute\Attribute;
use App\Models\DigiDocuments\Traits\Relationship\Relationship;

class DigiDocuments extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_documents";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "user_id", "category", "title", "attachment", "is_aadhar_pan_link", "notes", "created_at", "updated_at", 
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