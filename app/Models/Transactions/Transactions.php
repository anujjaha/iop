<?php 

namespace App\Models\Transactions;

/**
 * Class Transactions
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Transactions\Traits\Attribute\Attribute;
use App\Models\Transactions\Traits\Relationship\Relationship;

class Transactions extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_transactions";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "amount", "client_id", "created_at", "created_by", "credit", "debit", "id", "master_account_id", "notes", "transaction_date", "updated_at", "ipo_id", 'balance', 'monthly_fee'
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