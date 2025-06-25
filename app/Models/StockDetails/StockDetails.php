<?php 

namespace App\Models\StockDetails;

/**
 * Class StockDetails
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\StockDetails\Traits\Attribute\Attribute;
use App\Models\StockDetails\Traits\Relationship\Relationship;

class StockDetails extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_stock_details";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "code", "title", "external_link", "cmp", "cmp_at", "notes", "is_nse", "created_at", "updated_at", 
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