<?php 

namespace App\Models\Asset;

/**
 * Class Asset
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Asset\Traits\Attribute\Attribute;
use App\Models\Asset\Traits\Relationship\Relationship;

class Asset extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_assets";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "brand", "cost", "created_at", "id", "notes", "status", "title", "updated_at", 
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