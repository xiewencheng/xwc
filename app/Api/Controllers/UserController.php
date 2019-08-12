<?php

namespace App\Api\Controllers;
use Dingo\Api\Routing\Helpers;
use Dingo\Api\Exception\StoreResourceFailedException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Cate;
class UserController extends Controller
{
    public function register(Request $request){
        $valid = $this->valid($request->all());//验证表单
        if ($valid->fails()){
           return $this->sendFailResponse($valid->errors());
        }else{
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password)
            ]);
        }

        if ($user){
//            $token = JWTAuth::fromuser($user); //获取token
            return [
                "message" => "Registration Success",
                "status_code" => 201
            ];
        }else{
            return $this->sendFailResponse("Register Error");
        }
    }
    public function valid($data){
        return Validator::make($data,[
                'name'=>'required|unique:users|max:10',
                'email' => 'required|unique:users|email',
                'password'=>'required|min:6'
        ]);
    }
    public function sendFailResponse($message){
        return [
            'msg'=>400,
            'code'=>$message
        ];
    }
}