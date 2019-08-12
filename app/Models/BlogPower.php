<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPower extends Model
{
    //
    public $timestamps = false;

    protected $table = 'blog_power';

    protected $primaryKey='power_id';
}
