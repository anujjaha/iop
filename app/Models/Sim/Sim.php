<?php 

namespace App\Models\Sim;

/**
 * Class Sim
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Sim\Traits\Attribute\Attribute;
use App\Models\Sim\Traits\Relationship\Relationship;

class Sim extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_sim_cards";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "company", "cost", "created_at", "device_id", "id", "mobile_number", "notes", "plan_id", "purchase_date", "status", "updated_at", 
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