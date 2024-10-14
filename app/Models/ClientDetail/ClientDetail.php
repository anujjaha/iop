<?php 

namespace App\Models\ClientDetail;

/**
 * Class ClientDetail
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\ClientDetail\Traits\Attribute\Attribute;
use App\Models\ClientDetail\Traits\Relationship\Relationship;

class ClientDetail extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_client";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "aadhar_no", "address", "balance", "bank_account", "bank_branch", "bank_name", "birthdate", "created_at", "dmat_account", "dmat_co_name", "dmat_password", "dmat_user_name", "email", "id", "ifsc_code", "is_huf", "mobile", "name", "pan_no", "profit_loss", "start_date", "status", "updated_at", 
        "monthly_fee"
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

    public function getFullName()
    {
        return $this->name;
    }
}