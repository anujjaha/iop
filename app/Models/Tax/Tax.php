<?php 

namespace App\Models\Tax;

/**
 * Class Tax
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Tax\Traits\Attribute\Attribute;
use App\Models\Tax\Traits\Relationship\Relationship;

class Tax extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_tax";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "client_id", "ipo_id", "total_amount", "tax_amount", "profit_amount", "notes", "created_at", "updated_at", 
        "net_profit"
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