<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use think\response\Redirect;
use App\Models\BlogPower;
use App\Models\BlogUrro;
use App\Models\BlogProro;
use App\Models\BlogRole;
use App\Models\login;
use Illuminate\Support\Facades\DB;
class CommonController extends Controller
{
        protected $_login;
        public function __construct()
        {
            $_login = Session::get('login');
            if (!$_login){
                return redirect('login');
            }

            $this->_login = $_login;
            $wight = [
                'show',
                'olist',
                'add',
                'addto',
            ];
            if (in_array($wight)){
                return true;
            }

            //权限控制
            if (in_array($_login['power'])) {
                return redirect('login');
            }
        }
}