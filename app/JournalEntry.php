<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'journal_entry';


    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'journal_entry_id';

    /**
     * Use custom names for timestamps. By default laravel uses `created_at'
     * and `updated_at' timestamp columns. Instead we will use `created_time'
     * and `updated_time'.
     */
    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';


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
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship with account table (in terms of debit account)
    |--------------------------------------------------------------------------
    |
    | Has many-to-one relationship with account table.
    |
    */

    public function dr_account()
    {
        return $this->belongsTo('App\Account', 'dr_account_id', 'account_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship with account table (in terms of credit account)
    |--------------------------------------------------------------------------
    |
    | Has many-to-one relationship with account table.
    |
    */

    public function cr_account()
    {
        return $this->belongsTo('App\Account', 'cr_account_id', 'account_id');
    }
}
