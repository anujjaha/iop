<?php 

namespace App\Models\AllFdList;

/**
 * Class AllFdList
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\AllFdList\Traits\Attribute\Attribute;
use App\Models\AllFdList\Traits\Relationship\Relationship;

class AllFdList extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_fix_deposites";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "client_id", "fd_ref_no", "amount", "start_date", "end_date", "rate_of_int", "expected_monthly_int", "bank_name", "payout_type", "title", "notes", "created_at", "updated_at", 
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