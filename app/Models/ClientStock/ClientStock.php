<?php 

namespace App\Models\ClientStock;

/**
 * Class ClientStock
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\ClientStock\Traits\Attribute\Attribute;
use App\Models\ClientStock\Traits\Relationship\Relationship;

class ClientStock extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_client_stocks";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "buy_cost", "buy_date", "buy_qty", "client_id", "created_at", "id", "notes", "stock_id", "updated_at", 
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