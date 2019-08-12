<?php

namespace App\Http\Controllers\Desk;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use think\response\Redirect;
use Illuminate\Support\Facades\Session;
class FrontController extends Controller
{
    /*
     * 前台展示
     *
     * 编写人：颉文诚
     * */

    public function Index()
    {
        return view('front.desk');
    }


}