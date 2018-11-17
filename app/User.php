<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The user table name.
     *
     * @var array
     */
    protected $table = 'user';

    /**
     * Use different name for timestamps.
     */
    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';

    /*
    |--------------------------------------------------------------------------
    | Relationship with other tables.
    |--------------------------------------------------------------------------
    |
    | Basically one user will create many records for a given table. So, mostly
    | user will have one-to-many relation with most of the tables.
    |
    */

    /**
     * 2nd arg: name of foreign key column in other table
     * 3rd arg: name of primary key column in user table
     */
    public function bank_vouchers()
    {
        return $this->hasMany('App\BankVoucher', 'creator_id', 'id');
    }

    public function remittances()
    {
        return $this->hasMany('App\Remittance', 'creator_id', 'id');
    }

    public function remittance_lines()
    {
        return $this->hasMany('App\RemittanceLine', 'creator_id', 'id');
    }


    public function families()
    {
        return $this->hasMany('App\Family', 'creator_id', 'id');
    }

    public function persons()
    {
        return $this->hasMany('App\Person', 'creator_id', 'id');
    }

    public function oblates()
    {
        return $this->hasMany('App\Oblate', 'creator_id', 'id');
    }

    public function workers()
    {
        return $this->hasMany('App\Worker', 'creator_id', 'id');
    }
}
