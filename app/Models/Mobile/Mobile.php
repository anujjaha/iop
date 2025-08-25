<?php 

namespace App\Models\Mobile;

/**
 * Class Mobile
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Mobile\Traits\Attribute\Attribute;
use App\Models\Mobile\Traits\Relationship\Relationship;

class Mobile extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_mobile_devices";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "company", "cost", "created_at", "id", "is_smart", "notes", "purchase_date", "status", "title", "updated_at", 
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