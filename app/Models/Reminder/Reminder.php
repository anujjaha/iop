<?php 

namespace App\Models\Reminder;

/**
 * Class Reminder
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Reminder\Traits\Attribute\Attribute;
use App\Models\Reminder\Traits\Relationship\Relationship;

class Reminder extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_reminder";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "actual_time", "title", "notes", "frequency", "new_time", "reminder_tone", "user_id", "created_at", "updated_at", 
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