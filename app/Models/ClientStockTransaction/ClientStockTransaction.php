<?php 

namespace App\Models\ClientStockTransaction;

/**
 * Class ClientStockTransaction
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\ClientStockTransaction\Traits\Attribute\Attribute;
use App\Models\ClientStockTransaction\Traits\Relationship\Relationship;

class ClientStockTransaction extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_client_stock_transactions";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "brokerage_cost", "brokerage_percentage", "buy_cost", "buy_date", "buy_qty", "client_id", "created_at", "id", "is_loss", "is_profit", "net_loss", "net_profit", "notes", "sell_cost", "sell_date", "sell_qty", "stock_id", "tax", "total_transaction_value", "updated_at", 
        "net_value"
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