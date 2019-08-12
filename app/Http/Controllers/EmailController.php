<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class EmailController extends Controller
{
    public function index()
    {
        require_once("PHPMailer/PHPMailer.class.php");
        require_once("PHPMailer/SMTP.class.php");

        $title = "测试邮件";
        $content = "测试信哈哈哈哈哈";
        $to = "763084371@qq.com";
        sendMail($title,$content,$to);

        function sendMail($title,$content,$to)
        {
            $mail = new PHPMailer();
            $mail -> IsSMTP();						//告诉服务器使用smtp协议发送
            $mail -> SMTPAuth = true;				//开启SMTP授权
            $mail -> Host = 'smtp.163.com';			//告诉我们的服务器使用163的smtp服务器发送
            $mail -> From = '13522771231@163.com';	//发送者的邮件地址
            $mail -> FromName = 'three_tiger';			//发送邮件的用户昵称
            $mail -> Username = 'xwc';		//登录到邮箱的用户名
            $mail -> Password = 'xwc135';		//第三方登录的授权码，在邮箱里面设置
            //编辑发送的邮件内容
            $mail -> IsHTML(true);					//发送的内容使用html编写
            $mail -> CharSet = 'utf-8';				//设置发送内容的编码
            $mail -> Subject = $title;	//设置邮件的主题、标题
            $mail -> MsgHTML($content);				//发送的邮件内容主体
            //告诉服务器接收人的邮件地址
            $mail -> AddAddress($to);
            //调用send方法，执行发送
            $result = $mail -> Send();
            if($result){
                return true;
            }else{
                return $mail -> ErrorInfo;
            }

        }


    }
}
