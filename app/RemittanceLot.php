<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RemittanceLot extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'remittance_lot';


    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'remittance_lot_id';


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
        return $this->hasMany('App\Remittance', 'remittance_lot_id', 'remittance_lot_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship with user table.
    |--------------------------------------------------------------------------
    |
    | Has many-to-one relationship with user table.
    |
    */

    public function creator()
    {
	/**
	 * 2nd arg: name of foreign key column in bank_voucher table
	 * 3rd arg: name of primary key column in user table
	 */
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }
}
