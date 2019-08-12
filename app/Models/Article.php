<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    //
    public $timestamps = false;

    protected $table = 'article';

    protected $primaryKey='articleid';
    protected $fillable = ['articlename','email','content'];
    public static function selectAll(){
        return self::get();
    }
}
