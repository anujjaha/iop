<?php 

namespace App\Models\PaidInterest;

/**
 * Class PaidInterest
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\PaidInterest\Traits\Attribute\Attribute;
use App\Models\PaidInterest\Traits\Relationship\Relationship;

class PaidInterest extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_paid_interest";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "title", "amount", "pay_mode", "notes", "created_at", "updated_at", 
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