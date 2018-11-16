<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'person';


    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'person_id';


    /**
     * Use custom names for timestamps. By default laravel uses `created_at'
     * and `updated_at' timestamp columns. Instead we will use `created_time'
     * and `updated_time'.
     */
    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';


    /*
    |--------------------------------------------------------------------------
    | Relationship with worker table.
    |--------------------------------------------------------------------------
    |
    | There is a one-to-one relationship between person and worker.
    |
    */

    public function worker()
    {
	/**
	 * 2nd arg: name of foreign key column in worker table
	 * 3rd arg: name of primary key column in person table
	 */
        return $this->hasOne('App\Worker', 'person_id', 'person_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship with oblate table.
    |--------------------------------------------------------------------------
    |
    | There is a one-to-one relationship between person and oblate.
    |
    */

    public function oblate()
    {
	/**
	 * 2nd arg: name of foreign key column in oblate table
	 * 3rd arg: name of primary key column in person table
	 */
        return $this->hasOne('App\Oblate', 'person_id', 'person_id');
    }
}
