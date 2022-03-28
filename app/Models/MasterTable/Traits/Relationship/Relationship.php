<?php 

namespace App\Models\MasterTable\Traits\Relationship;

use App\Models\TableField\TableField;

trait Relationship
{
    /**
     * Table Fields ( Has May Relationship)
     * 
     */
    public function table_fields()
    {
        return $this->hasMany(TableField::class, 'master_table_id');
    }
}