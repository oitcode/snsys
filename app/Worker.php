<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'worker';


    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'worker_id';


    /**
     * Use custom names for timestamps. By default laravel uses `created_at'
     * and `updated_at' timestamp columns. Instead we will use `created_time'
     * and `updated_time'.
     */
    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';


    /*
    |--------------------------------------------------------------------------
    | Relationship of worker table with person table.
    |--------------------------------------------------------------------------
    |
    | There is a one-to-one relationship between worker and person.
    |
    */

    public function person()
    {
	/**
	 * 2nd arg: name of foreign key column in worker table
	 * 3rd arg: name of primary key column in person table
	 */
        return $this->belongsTo('App\Person', 'person_id', 'person_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship with oblate table.
    |--------------------------------------------------------------------------
    |
    | One worker has many oblates.
    |
    */

    public function oblates()
    {
	/**
	 * 2nd arg: name of foreign key column in oblate table
	 * 3rd arg: name of primary key column in worker table
	 */
        return $this->hasMany('App\Oblate', 'ritwik_id', 'worker_id');
    }
}
