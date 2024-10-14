<?php 

namespace App\Models\Loss;

/**
 * Class Loss
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Loss\Traits\Attribute\Attribute;
use App\Models\Loss\Traits\Relationship\Relationship;

class Loss extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_company_loss";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "client_id", "created_at", "executed_on", "id", "loss_amount", "notes", "updated_at", 
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