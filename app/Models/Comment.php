<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public $timestamps = false;

    protected $table = 'comment';

    protected $primaryKey='comm_id';


}