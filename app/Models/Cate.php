<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //
    public $timestamps = false;

    protected $table = 'cate';

    protected $primaryKey='cate-id';

    public function Tree($data,$pid=0,$level = 0)
    {
        static $list = [];
        foreach ($data as $key => $value)
        {
            if($value['fid'] == $pid){
                $value['level'] = $level;
                $list[] = $value;
                unset($data[$key]);
                $this->Tree($data,$value['cateid'],$level+1);
            }
        }
        return $list;
    }
    public static function html($list)
    {
        foreach ($list as $key => $value)
        {
            $data[$value['cateid']] = str_repeat('|----',$value['level']).$value['cate_name'];
        }
        return $data;
    }
}
