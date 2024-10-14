<?php 

namespace App\Models\Main;

/**
 * Class Main
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Main\Traits\Attribute\Attribute;
use App\Models\Main\Traits\Relationship\Relationship;

class Main extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_main";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "name", "bank", "branch", "account_number", "ifsc", "balance", "notes", "created_at", "updated_at", 
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