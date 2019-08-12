<?php

namespace App\Api\Controllers;
use Dingo\Api\Routing\Helpers;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Cate;
use App\Models\Article;
class StoreController extends Controller
{
    /*
     * 文章展示
     *
     * 编写人：颉文诚
     * */
    public function Store()
    {
            $ret = Article::all();
            if ($ret)
            {
                return [
                    'code'=>200,
                    'ret'=>$ret,
                ];
            }else{
                return [
                    'code'=>400,
                ];
            }
    }

    /*
     *
     * 删除
     *
     * 编写人：颉文诚
     * */
    public function Delete($id)
    {

        if (Article::destroy($id)===1){
            return $this->sendSuccessResponse("Delete Success",201);
        }else{
            return $this->sendFailResponse("Delete Fail",500);
        }
    }

    public function sendSuccessResponse($message){
        return [
            'code'=>201,
            'msg'=>$message
        ];
    }

    public function sendFailResponse($message){
        return[
          'code'=>500,
          'msg'=>$message
        ];
    }

    /*
     * 刷新 注册
     *
     * 编写人：颉文诚
     * */

    public function refresh(){
        //获取到过期的token
        $old_token = JWTAuth::gettoken();
        //刷新token并返回
        $new_token = JWTAuth::refresh($old_token);
        //摧毁过期token
        JWTAuth::invalidate($old_token);
        return [
            'token'=>$new_token,
            'status_code'=>201
        ];
    }
    /*
     *分类展示
     *
     * 编写人：颉文诚
     * */

    public function Cate()
    {
        $data = Cate::all()->toArray();

        $cate = new Cate();
        $tree = $cate->Tree($data);
        $list = $cate->html($tree);

//        foreach ($data as $key=>$value)
//        {
//            foreach ($value as $ke=>$val)
//            {
//                $arr[] = $val;
//            }
//        }
//        var_dump($arr);die();
        return [
            'data'=>$list,
            'status_code'=>201
        ];
    }


    public function Comments()
    {
        $data = DB::table('comment')
            ->join('users','comm_id','=','id')
            ->join('article','comm_id','=','articleid')
            ->select('comm_id','id','email','content','comm_time','parent_id','give','articlename','comm_conts')
            ->get();

        $data = json_decode(json_encode($data), true);
        $data = $this->getSubTree($data);
        foreach ($data as $key => $val)
        {
            foreach ($val as $k => $v)
            {
                $arr[] = $v;
            }
        }

         return [
             'data'=>$arr,
             'code'=>201
         ];
    }
    public function getSubTree($data,$pid=0)
    {
        $tmp = [];
        foreach ($data as $key => $value)
        {
            if ($value['parent_id'] == $pid){
                $tmp[$key] = [$value];
                $tmp[$key]['son'] = $this->getSubTree($data,$value['comm_id']);
            }
            }
        return $tmp;
    }

 
}