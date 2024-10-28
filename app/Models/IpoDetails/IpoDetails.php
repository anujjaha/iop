<?php 

namespace App\Models\IpoDetails;

/**
 * Class IpoDetails
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\IpoDetails\Traits\Attribute\Attribute;
use App\Models\IpoDetails\Traits\Relationship\Relationship;

class IpoDetails extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_Ipodetails";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "block_amt", "closing_date", "created_at", "gmp_latest", "id", "ipo_name", "ipo_type", "listed_price", "listing_date", "lot_size", "notes", "opening_date", "refund_date", "updated_at", 
        "external_link",
        "min_lot_size",
        "max_lot_size",
        "price_band",
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