<?php 

namespace App\Models\Visit;

/**
 * Class Visit
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Visit\Traits\Attribute\Attribute;
use App\Models\Visit\Traits\Relationship\Relationship;

class Visit extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "user_visits";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "content_id", "user_id", "actionType", "ip", "user_agent", "created_at", "updated_at", 
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