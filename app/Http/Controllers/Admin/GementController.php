<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use think\response\Redirect;
use App\Models\BlogPower;
use App\Models\BlogUrro;
use App\Models\BlogProro;
use App\Models\BlogRole;
use App\Models\login;
use Illuminate\Support\Facades\DB;
class GementController extends Controller
{
    /*
     * 管理员管理
     *
     * 编写人：颉文诚 tel：13522771231
     * */

    /*
     * 管理员列表
     *
     * 编写人：颉文诚
     * */

    public function Index()
    {

        $data = DB::table('login')
            ->join('bolg_role', 'bolg_role.role_id', '=', 'login.login_id')
            ->select('adminuser', 'role_name', 'login_id')
            ->paginate(2);
        return view('layouts.gemlist',['data'=>$data]);
    }


    /*
     *
     * 管理添加
     * 编写人：颉文诚
     * */

    public function AdminAdd()
    {
        return view('layouts.adminadd');
    }
    public function AdminAddto(Request $request)
    {
        $data = $request->input();
        $Login = new Login();
        $Blogrole = new BlogRole();
        $Login->adminuser = $data['adminuser'];
        $Login->adminpwd = $data['adminpwd'];
        $Blogrole->role_name = $data['role_name'];
        $Login->save();
        $res = $Blogrole->save();
        if ($res) {
            return json_encode(['code'=>'2000','msg'=>'增加成功','status'=>'true']);
        }else{
            return json_encode(['code'=>'2001','msg'=>'增加失败','status'=>false]);
        }
    }

    /*
     * 角色权限
     *
     * 编写人：颉文诚
     * */
    public function Role()
    {
        $data = DB::table('bolg_role')
            ->join('blog_power', 'bolg_role.role_id', '=', 'blog_power.power_id')
            ->select('name', 'role_name', 'text','role_id')
            ->paginate(2);
        return view('layouts.role',['data'=>$data]);
    }

    /*
     * 角色权限添加
     *
     * 编写人：颉文诚
     * */

    public function Power()
    {
        return view('layouts.power');
    }
    public function Powerto(Request $request)
    {
        $data = $request->input();
        $Blogrole = new BlogRole();
        $BlogPower = new BlogPower();
        $Blogrole->role_name = $data['role_name'];
        $BlogPower->text = $data['text'];
        $BlogPower->name = $data['str'];
        $Blogrole->save();
        $res = $BlogPower->save();
        if ($res) {
            return json_encode(['code'=>'2000','msg'=>'增加成功','status'=>'true']);
        }else{
            return json_encode(['code'=>'2000','msg'=>'增加失败','status'=>false]);
        }
    }

    /*
     *
     * 权限分类
     *
     * 编写人：颉文城
     * */

    public function Pocate()
    {
        $list = BlogPower::paginate(2);
        return view('layouts.pocate',['list'=>$list]);
    }

    /*
     * 权限分类添加
     *
     * */
    public function Pocateadd()
    {
        $classify = $_POST['classify'];
        $BlogPower = new BlogPower();
        $BlogPower->classify = $classify;
        $BlogPower->save();
    }

    /*
     * 权限分配
     *
     * 编写人：颉文诚
     * */
    public function rule()
    {
        $list = BlogPower::paginate(2);
        return view('layouts.rule',['list'=>$list]);
    }

    /*
     * 权限添加
     *
     * 编写人：颉文诚
     * */
    public function ruleadd()
    {
        $classify = $_POST['classify'];
        $c = $_POST['c'];
        $a = $_POST['a'];
        $BlogPower = new BlogPower();
        $BlogPower->classify = $classify;
        $BlogPower->c = strtolower($c);
        $BlogPower->a = strtolower($a);
        $BlogPower->ca = strtolower($c).'/'.strtolower($a);
        $BlogPower->save();
     }

     /*
      * 角色权限 删除
      *
      * 编写人：颉文诚
      * */

     public function Del(){
        $id = $_POST['id'];
        Db::beginTransaction();
        $res1 = DB::table('bolg_role')->where('role_id',$id)->delete();

        $res2 = DB::table('blog_proro')->where('role_id',$id)->delete();

        $res3 = DB::table('blog_urro')->where('r_id',$id)->delete();
        if ($res1 & $res2 & $res3){
            DB::commit();
            return json_encode(['code'=>'2000','msg'=>'删除成功','status'=>'true']);
        }else{
            DB::rollBack();
            return json_encode(['code'=>'2000','msg'=>'删除失败','status'=>false]);
        }
     }
}