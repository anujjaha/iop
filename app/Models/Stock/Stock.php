<?php 

namespace App\Models\Stock;

/**
 * Class Stock
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Stock\Traits\Attribute\Attribute;
use App\Models\Stock\Traits\Relationship\Relationship;

class Stock extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_stock";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "client_id", "title", "code", "cost", "qty", "cmp", "external_link", "notes", "created_at", "updated_at", 
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