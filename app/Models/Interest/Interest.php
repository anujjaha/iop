<?php 

namespace App\Models\Interest;

/**
 * Class Interest
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Interest\Traits\Attribute\Attribute;
use App\Models\Interest\Traits\Relationship\Relationship;

class Interest extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_interest";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "client_id", "created_at", "credit_date", "id", "title", "updated_at", "amount"
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