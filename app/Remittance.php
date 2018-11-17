<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remittance extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'remittance';


    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'remittance_id';


    /**
     * Use custom names for timestamps. By default laravel uses `created_at'
     * and `updated_at' timestamp columns. Instead we will use `created_time'
     * and `updated_time'.
     */
    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';


    /*
    |--------------------------------------------------------------------------
    | Relationship with bank_voucher table.
    |--------------------------------------------------------------------------
    |
    | Has many-to-one relationship with bank_voucher table.
    |
    */

    public function bank_voucher()
    {
	/**
	 * 2nd arg: name of foreign key column in remittance table
	 * 3rd arg: name of primary key column in bank_voucher table
	 */
        return $this->belongsTo('App\BankVoucher', 'bank_voucher_id', 'bank_voucher_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship with family table.
    |--------------------------------------------------------------------------
    |
    | Has many-to-one relationship with family table.
    |
    */

    public function family()
    {
	/**
	 * 2nd arg: name of foreign key column in remittance table
	 * 3rd arg: name of primary key column in family_table
	 */
        return $this->belongsTo('App\Family', 'family_id', 'family_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship with oblate table.
    |--------------------------------------------------------------------------
    |
    | Has many-to-one relationship with oblate table.
    |
    */

    public function submitter()
    {
	/**
	 * 2nd arg: name of foreign key column in remittance table
	 * 3rd arg: name of primary key column in oblate table
	 */
        return $this->belongsTo('App\Oblate', 'submitter_id', 'oblate_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship with remittance_line table.
    |--------------------------------------------------------------------------
    |
    | One remittance has many remittance_lines.
    |
    */

    public function remittance_lines()
    {
	/**
	 * 2nd arg: name of foreign key column in remittance_line table
	 * 3rd arg: name of primary key column in remittance table
	 */
        return $this->hasMany('App\RemittanceLine', 'remittance_id', 'remittance_id');
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
	 * 2nd arg: name of foreign key column in remittance table
	 * 3rd arg: name of primary key column in user table
	 */
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }
}
