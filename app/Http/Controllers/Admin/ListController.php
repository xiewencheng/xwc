<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use think\response\Redirect;
use App\Models\BlogPower;
use App\Models\Article;
use App\Models\Cate;
class ListController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     * 展示 文章管理 文章添加
     * 编写人：颉文诚
     */
    public function Index()
    {
        $power = Session::get('login');

        foreach ($power['power_ids'] as $k => $v){
            foreach ($v as $ke => $vv){
                     $arr[] = $vv;

            }
        }
        $data = BlogPower::whereIn('power_id',$arr)->select('ca','pid','power_id')->get();
        $data = $this->ltree($data);
        return view('layouts.list',['data'=>$data]);
    }
    public function Ltree($data,$pid=0)
    {
        $childd = [];
        foreach ($data as $k=>$v) {
            if ($v['pid'] == $pid)
            {
                $childd[$k]=$v;
                $childd[$k]['childss'] = $this->ltree($data,$v['power_id']);
            }
        }
        return $childd;
    }

    public function Olist()
    {
        $list = Article::paginate(2);

        return view('layouts.olist',['list'=>$list]);
    }

    public function Add()
    {
        return view('layouts.add');
    }
    public function Addto(Request $request)
    {
        $data = $request->input();
        $Article = new Article();
        $Article->articlename = $data['articlename'];
        $Article->content = $data['content'];
        $Article->adminuser = $data['adminuser'];
        $Article->phone = $data['phone'];
        $Article->email = $data['email'];
        $Article->jointime = $data['jointime'];
        $res = $Article->save();
        if ($res) {
            return json_encode(['code'=>'2000','msg'=>'增加成功','status'=>'true']);
        }else{
            return json_encode(['code'=>'2001','msg'=>'增加失败','status'=>false]);
        }
    }
    /*
     *
     * 多级分类
     *
     * 编写人：颉文诚
     * */
    public function Cate()
    {
        $data = Cate::all()->toArray();
        $data = $this->trre($data);
        var_dump($data);die();
        return view('layouts.cate',['data'=>$data]);
    }
    public function Trre($data,$pid=0){
        $child=[];
        foreach ($data as $k=>$v)
        {
            if ($v['fid'] == $pid)
            {
                $child[$k] = [$v];
                $child[$k]['childs'] = $this->trre($data,$v['cateid']);
            }
        }
        return $child;
    }
    /*
     *
     * 添加子集栏目
     *
     * 编写人：颉文诚
     * */
    public function Subtopic()
    {
        $list = Cate::where('fid',0)->get()->toArray();
        $data1 = [];
        foreach ($list as $k=>$v)
        {
            $data1[] = $v['cateid'];
            $data1[] = $v['fid'];
            $data1[] = $v['switch'];
        }
        return view('layouts.subtopic',['data1'=>$data1]);
    }
    public function Subtopicto(Request $request)
    {
        $data = $request->input();
        $cate = new cate();
        $cate->cate_name = $data['cate_name'];
        $cate->order = $data['order'];
        $cate->switch = $data['aa'];
        $cate->fid = $data['fid'];
        $res = $cate->save();
        if ($res) {
        return json_encode(['code'=>'2000','msg'=>'增加成功','status'=>'true']);
    }else{
        return json_encode(['code'=>'2001','msg'=>'增加失败','status'=>false]);
    }
    }
    /*
     *
     *分类状态修改
     *
     * 编写人：颉文诚
     * */
    public function Save()
    {
        $id = $_GET['cateid'];
        $data = Cate::where(['cateid'=>$id])->first()->toArray();
        if ($data['switch'] == 1)
        {
            $res = Cate::where(['cateid'=>$id])->update(['switch'=>'0']);
        }else{
            $res = Cate::where(['cateid'=>$id])->update(['switch'=>'1']);
        }
        if ($res){
            return json_encode(['code'=>'2000','msg'=>'修改成功','status'=>'true']);
        }else{
            return json_encode(['code'=>'2001','msg'=>'修改失败','status'=>false]);
        }
    }
    /*
     * 文章状态修改
     *
     * 编写人:颉文诚
     * */
    public function Sate()
    {
        $id = $_GET['id'];
        $data = Article::where(['articleid'=>$id])->first()->toArray();
        if ($data['state'] == 1) {
            $res = Article::where(['articleid'=>$id])->update(['state'=>'0']);
        }else{
            $res = Article::where(['articleid'=>$id])->update(['state'=>'1']);
        }
        if ($res) {
            return json_encode(['code'=>'2000','msg'=>'修改成功','status'=>'true']);
        }else{
            return json_encode(['code'=>'2001','msg'=>'修改失败','status'=>false]);
        }
    }

    /*
     * 文章删除
     *
     * 编写人：颉文诚
     * */
    public function Listdel()
    {
        $id = $_POST['id'];
        $res = Article::where(['articleid'=>$id])->delete();
        if ($res) {
            return json_encode(['code'=>'2000','msg'=>'删除成功','status'=>'true']);
        }else{
            return json_encode(['code'=>'2000','msg'=>'删除失败','status'=>false]);
        }
    }

    /*
     * 文章批量删除
     *
     * 编写人：颉文诚
     * */
    public function ListDelall()
    {
        $id = $_POST['sid'];

        $res = Article::whereIn('articleid',$id)->delete();
        if($res){
            return json_encode(['code'=>'2000','msg'=>'删除成功','status'=>'true']);
        }else{
            return json_encode(['code'=>'2000','msg'=>'删除失败','status'=>false]);
        }
    }

}