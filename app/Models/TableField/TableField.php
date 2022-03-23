<?php

namespace App\Models\TableField;

/**
 * Class TableField
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\TableField\Traits\Attribute\Attribute;
use App\Models\TableField\Traits\Relationship\Relationship;

class TableField extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "table_fields";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "created_at", "default_value", "field_name", "field_type", "id", "is_index_field", "is_nullable", "is_primary_field", "is_soft_delete", "is_unique_field", "master_table_id", "updated_at", 
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