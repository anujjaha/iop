<?php 

namespace App\Models\Gift;

/**
 * Class Gift
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Gift\Traits\Attribute\Attribute;
use App\Models\Gift\Traits\Relationship\Relationship;

class Gift extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_gifts";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "amount", "client_id", "created_at", "id", "notes", "updated_at", "user_id", 
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