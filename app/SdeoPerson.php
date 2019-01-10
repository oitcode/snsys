<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SdeoPerson extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sdeo_person';


    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'sdeo_person_id';
}
