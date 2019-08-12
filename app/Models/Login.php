<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BlogPower;
use App\Models\BlogUrro;
use App\Models\BlogProro;
use App\Models\BlogRole;

class Login extends Model
{
    //
    public $timestamps = false;

    protected $table = 'login';

    protected $primaryKey='login_id';

    public function selectOne($adminuser,$adminpwd)
    {
        //查询用户表
        $userInfo = $this->where(['adminuser'=>$adminuser,'adminpwd'=>$adminpwd])->first();
        if(!$userInfo){
            return false;
        }
        //查询用户-角色关系表
        $roleIds = BlogUrro::where('u_id',$userInfo['login_id'])->select('r_id')->get()->toArray();
        if (!$roleIds){
            return false;
        }


        //角色ID->角色权限关系表获取权限ID
        $powerIds = BlogProro::where('role_id',$roleIds)->select('power_id')->get()->toArray();

        //查看权限信息
        $powerList = BlogPower::where('power_id',$powerIds)->select('ca','power_id')->get()->toArray();

        return ['power'=>$powerList,'power_ids'=>$powerIds];
    }

}
