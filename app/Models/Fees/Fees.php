<?php 

namespace App\Models\Fees;

/**
 * Class Fees
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Fees\Traits\Attribute\Attribute;
use App\Models\Fees\Traits\Relationship\Relationship;

class Fees extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_monthly_fees";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "client_id", "created_at", "fee_amount", "id", "month_title", "notes", "updated_at", 
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