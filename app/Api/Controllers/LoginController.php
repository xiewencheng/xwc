<?php

namespace App\Api\Controllers;
use Dingo\Api\Routing\Helpers;
use Dingo\Api\Exception\StoreResourceFailedException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
class LoginController extends Controller
{
    public function Login(Request $request)
    {
        $user = User::where('name',$request->email)->orwhere('email',$request->email)->firstOrFail();
        if ($user && Hash::check($request->password,$user->password)){
            $token=JWTAuth::fromuser($user);//获取token
            return array([
                'token'=>$token,
                'message'=>"Login Success",
                'status_code'=>'200'
            ]);
        }else{
            throw new UnauthorizedHttpException("Login Failed");
        }
    }
}