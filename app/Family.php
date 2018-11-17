<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'family';


    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'family_id';


    /**
     * Use custom names for timestamps. By default laravel uses `created_at'
     * and `updated_at' timestamp columns. Instead we will use `created_time'
     * and `updated_time'.
     */
    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';


    /*
    |--------------------------------------------------------------------------
    | Relationship with oblate table.
    |--------------------------------------------------------------------------
    |
    | One family has many oblates.
    |
    */

    public function oblates()
    {
	/**
	 * 2nd arg: name of foreign key column in oblate table
	 * 3rd arg: name of primary key column in family table
	 */
        return $this->hasMany('App\Oblate', 'family_id', 'family_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship with remittance table.
    |--------------------------------------------------------------------------
    |
    | One family has many remittances.
    |
    */

    public function remittances()
    {
	/**
	 * 2nd arg: name of foreign key column in remittance table
	 * 3rd arg: name of primary key column in family table
	 */
        return $this->hasMany('App\Remittance', 'family_id', 'family_id');
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
	 * 2nd arg: name of foreign key column in family table
	 * 3rd arg: name of primary key column in user table
	 */
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }
}
