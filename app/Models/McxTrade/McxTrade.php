<?php 

namespace App\Models\McxTrade;

/**
 * Class McxTrade
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\McxTrade\Traits\Attribute\Attribute;
use App\Models\McxTrade\Traits\Relationship\Relationship;

class McxTrade extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_mcx_transactions";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "client_id", "mcx_code", "qty", "buy_price", "sell_price", "additional_bcost", "additional_scost", "additional_total", "trade_type", "trade_date", "settle_date", "profit_loss", "net_profit_loss", "is_settle", "tmonth", "created_at", "updated_at", 
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