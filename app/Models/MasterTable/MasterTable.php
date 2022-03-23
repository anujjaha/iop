<?php

namespace App\Models\MasterTable;

/**
 * Class MasterTable
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\MasterTable\Traits\Attribute\Attribute;
use App\Models\MasterTable\Traits\Relationship\Relationship;

class MasterTable extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "master_tables";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "created_at", "deleted_at", "execute_date_time", "id", "is_executed", "is_migrated", "migrated_date_time", "notes", "title", "updated_at", 
        "extra_notes", "module_name"
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