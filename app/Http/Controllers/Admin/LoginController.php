<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use App\Http\Requests\logincheck;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Login;
use think\response\Redirect;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    /*
     * LoginController
     * 管理登录
     * 编写人：颉文诚 email：13522771231@163.com
     */
    public function Index()
    {
        return view('layouts.login');
    }
    public function Login()
    {
        $adminuser = $_GET['adminuser'];
        $adminpwd = $_GET['adminpwd'];
        $login = new Login();
        $res = $login->selectOne($adminuser,$adminpwd);
//        if (auth()->attempt($request->only(['adminuser','adminpwd']))) {
//            echo "<script>alert('登录成功');location.href='show'</script>";
//        }else {
//                return redirect()->back()->withErrors(['errors'=>'呵呵']);
//        }
        session::put('login',$res);
        if ($res) {
            return redirect('show');
        }else {
            return redirect('login');
        }

    }
}