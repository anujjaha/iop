<?php 

namespace App\Models\IpoAssignments;

/**
 * Class IpoAssignments
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\IpoAssignments\Traits\Attribute\Attribute;
use App\Models\IpoAssignments\Traits\Relationship\Relationship;

class IpoAssignments extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_ipoassignments";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "alloted_date", "applied_date", "client_id", "created_at", "id", "ipo_id", "notes", "opening_rate", "profit_loss", "refund_date", "return_date", "revoked_date", "sell_date", "sell_price", "status", "updated_at", 
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

    public function getStatusAttribute($status)
    {
        switch($status)
        {
            case 1:
                return 'Applied';
                break;

            case 2:
                return 'Revoke';
                break;

            case 3:
                return 'Allotted';
                break;

        }

        return 'Not Applied';
    }
}