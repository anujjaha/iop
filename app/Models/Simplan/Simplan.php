<?php 

namespace App\Models\Simplan;

/**
 * Class Simplan
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Simplan\Traits\Attribute\Attribute;
use App\Models\Simplan\Traits\Relationship\Relationship;

class Simplan extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_sim_plans";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "cost", "created_at", "current_plan", "expire_date", "id", "recharge_date", "sim_id", "title", "updated_at", 
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