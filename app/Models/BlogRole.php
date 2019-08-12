<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogRole extends Model
{
    //
    public $timestamps = false;

    protected $table = 'bolg_role';

    protected $primaryKey='role_id';
}
