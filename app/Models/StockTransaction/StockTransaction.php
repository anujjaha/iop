<?php 

namespace App\Models\StockTransaction;

/**
 * Class StockTransaction
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\StockTransaction\Traits\Attribute\Attribute;
use App\Models\StockTransaction\Traits\Relationship\Relationship;

class StockTransaction extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_stock_transaction";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "stock_id", "client_id", "buy_price", "sell_price", "qty", "profit_loss", "notes", "created_at", "updated_at", 
        "net_profit",
        "tax",
        "brokerage_cost"
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