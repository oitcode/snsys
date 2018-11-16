<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankVoucher extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bank_voucher';


    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'bank_voucher_id';


    /**
     * Use custom names for timestamps. By default laravel uses `created_at'
     * and `updated_at' timestamp columns. Instead we will use `created_time'
     * and `updated_time'.
     */
    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';


    /*
    |--------------------------------------------------------------------------
    | Relationship with remittance table.
    |--------------------------------------------------------------------------
    |
    | One bank_voucher has many remittances.
    |
    */

    public function remittances()
    {
	/**
	 * 2nd arg: name of foreign key column in remittance table
	 * 3rd arg: name of primary key column in bank_voucher table
	 */
        return $this->hasMany('App\Remittance', 'bank_voucher_id', 'bank_voucher_id');
    }
}
