<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.2</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/xadmin.css">
    <script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="articlename" class="layui-form-label">
                    <span class="x-red">*</span>文章名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="articlename" name="articlename" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>将会成为您唯一的名称
                </div>
            </div>
            <div class="layui-form-item">
                <label for="adminuser" class="layui-form-label">
                    <span class="x-red">*</span>登录名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="adminuser" name="adminuser" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>将会成为您唯一的登入名
                </div>
            </div>
            <div>
                <label for="adminuser" class="layui-form-label">
                    <span class="x-red">*</span>文章内容
                </label>
                <textarea name="content" id="content" style="display: none;"></textarea>
            </div>

            <div class="layui-form-item">
                <label for="phone" class="layui-form-label">
                    <span class="x-red">*</span>手机
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="phone" name="phone" required="" lay-verify="phone"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>将会成为您唯一的登入名
                </div>
            </div>
            <div class="layui-form-item">
                <label for="email" class="layui-form-label">
                    <span class="x-red">*</span>邮箱
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="email" name="email" required="" lay-verify="email"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="x-red">*</span>状态</label>
                <div class="layui-input-block">
                    <input type="checkbox" name="state" lay-skin="primary" title="启用" checked="" id="state">
                    <input type="checkbox" name="state" lay-skin="primary" title="不启用" checked="" id="state">
                </div>
            </div>
            <div class="layui-inline layui-show-xs-block">
                <input class="layui-input"  autocomplete="off" placeholder="加入时间" name="jointime" id="jointime">
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button  class="layui-btn" lay-filter="add" lay-submit="" id="add">
                    增加
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    layui.use('layedit', function(){
        var layedit = layui.layedit;
        layedit.build('content'); //建立编辑器
    });
    layui.use(['form', 'layer'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            //自定义验证规则
            form.verify({
                nikename: function(value) {
                    if (value.length < 5) {
                        return '昵称至少得5个字符啊';
                    }
                },
            });
            layui.use(['laydate','form'], function(){
                var laydate = layui.laydate;

                //执行一个laydate实例
                laydate.render({
                    elem: '#jointime', //指定元素
                    trigger:'click'
                });

            });

            /*
            * 文章添加
            * */
            $('#add').on('click',function () {
                var articlename = $('#articlename').val();
                var content = $('#content').val();
                var adminuser = $('#adminuser').val();
                var phone = $('#phone').val();
                var email = $('#email').val();
                var jointime = $('#jointime').val();

                $.ajax({
                    url:'addto',
                    type:'post',
                    data:{articlename:articlename,content:content,adminuser:adminuser,phone:phone,email:email,jointime:jointime},
                    dataType:'json',
                    success:function (res) {
                        if (res.status == 'true') {
                            layer.msg(res.msg);
                        }else
                        {
                            layer.msg(res.msg);
                            return false;
                        }
                    }
                })
            })
            //监听提交
            form.on('button(add)',

                function(data) {
                    
                    console.log(data);
                    //发异步，把数据提交给php
                    layer.alert("增加成功", {
                            icon: 6
                        },
                        function() {
                            //关闭当前frame
                            xadmin.close();

                            // 可以对父窗口进行刷新
                            xadmin.father_reload();
                        });
                    return false;
                });

        });</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>
