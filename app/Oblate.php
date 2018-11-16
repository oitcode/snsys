<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oblate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oblate';


    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'oblate_id';


    /**
     * Use custom names for timestamps. By default laravel uses `created_at'
     * and `updated_at' timestamp columns. Instead we will use `created_time'
     * and `updated_time'.
     */
    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';


    /*
    |--------------------------------------------------------------------------
    | Relationship of oblate table with person table.
    |--------------------------------------------------------------------------
    |
    | There is a one-to-one relationship between oblate and person.
    |
    */

    public function person()
    {
	/**
	 * 2nd arg: name of foreign key column in oblate table
	 * 3rd arg: name of primary key column in person table
	 */
        return $this->belongsTo('App\Person', 'person_id', 'person_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship of oblate table with family table.
    |--------------------------------------------------------------------------
    |
    | There is a many-to-one relationship between oblate and family.
    |
    */

    public function family()
    {
	/**
	 * 2nd arg: name of foreign key column in oblate table
	 * 3rd arg: name of primary key column in family table
	 */
        return $this->belongsTo('App\Family', 'family_id', 'family_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship of oblate table with worker table.
    |--------------------------------------------------------------------------
    |
    | There is a many-to-one relationship between oblate and worker.
    |
    */

    public function worker()
    {
	/**
	 * 2nd arg: name of foreign key column in oblate table
	 * 3rd arg: name of primary key column in worker table
	 */
        return $this->belongsTo('App\Worker', 'ritwik_id', 'worker_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship with remittance table.
    |--------------------------------------------------------------------------
    |
    | One oblate has (submitted) many remittances.
    |
    */

    public function remittances()
    {
	/**
	 * 2nd arg: name of foreign key column in remittance table
	 * 3rd arg: name of primary key column in oblate table
	 */
        return $this->hasMany('App\Remittance', 'submitter_id', 'oblate_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship with remittance_line table.
    |--------------------------------------------------------------------------
    |
    | One oblate has many remittance_lines.
    |
    */

    public function remittance_lines()
    {
	/**
	 * 2nd arg: name of foreign key column in remittance_line table
	 * 3rd arg: name of primary key column in oblate table
	 */
        return $this->hasMany('App\RemittanceLine', 'oblate_id', 'oblate_id');
    }
}
