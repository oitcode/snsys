<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RemittanceLine extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'remittance_line';


    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'remittance_line_id';


    /**
     * Use custom names for timestamps. By default laravel uses `created_at'
     * and `updated_at' timestamp columns. Instead we will use `created_time'
     * and `updated_time'.
     */
    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';


    /*
    |--------------------------------------------------------------------------
    | Relationship of remittance_line table with remittance table.
    |--------------------------------------------------------------------------
    |
    | There is a many-to-one relationship between remittance_line and remittance.
    |
    */

    public function remittance()
    {
	/**
	 * 2nd arg: name of foreign key column in remittance_line table
	 * 3rd arg: name of primary key column in remittacne table
	 */
        return $this->belongsTo('App\Remittance', 'remittance_id', 'remittance_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship of remittance_line table with oblate table.
    |--------------------------------------------------------------------------
    |
    | There is a many-to-one relationship between remittance_line and oblate.
    |
    */

    public function oblate()
    {
	/**
	 * 2nd arg: name of foreign key column in remittance_line table
	 * 3rd arg: name of primary key column in oblate table
	 */
        return $this->belongsTo('App\Oblate', 'oblate_id', 'oblate_id');
    }
}
