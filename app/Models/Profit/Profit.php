<?php 

namespace App\Models\Profit;

/**
 * Class Profit
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Profit\Traits\Attribute\Attribute;
use App\Models\Profit\Traits\Relationship\Relationship;

class Profit extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_profit";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "client_id", "profit_amount", "notes", "executed_on", "created_at", "updated_at", 
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