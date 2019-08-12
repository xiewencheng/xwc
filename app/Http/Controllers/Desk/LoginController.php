<?php

namespace App\Http\Controllers\Desk;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use think\response\Redirect;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    /*
     * 前台登录展示
     *
     *
     * 编写人：颉文诚
     * */

    public function Login()
    {
        return view('front.login');
    }
    /*
     * 前台注册
     *
     *编写人：颉文诚
     * */

    public function registered()
    {
        return view('front.registered');
    }
}