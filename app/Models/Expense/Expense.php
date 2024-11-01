<?php 

namespace App\Models\Expense;

/**
 * Class Expense
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Expense\Traits\Attribute\Attribute;
use App\Models\Expense\Traits\Relationship\Relationship;

class Expense extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_expenses";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "amount", "category", "created_at", "created_by", "id", "notes", "title", "updated_at", "user_id", 
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