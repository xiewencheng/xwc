<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Amaze UI Examples</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="css/amazeui.min.css">
    <link rel="stylesheet" href="css/app2.css">
</head>
<body>

<div class="am-g">
    <!-- LOGO -->
    <div class="am-u-sm-12 am-text-center" >
        <i class="am-icon-twitch myapp-login-logo"></i>
    </div>
    <!-- 登陆框 -->
    <div class="am-u-sm-11 am-u-sm-centered" id="box">

            <fieldset class="myapp-login-form am-form-set">
                <div class="am-form-group am-form-icon">
                    <i class="am-icon-user"></i>
                    <input type="text" ref="email" class="myapp-login-input-text am-form-field" placeholder="请输入您的账号邮箱">
                </div>
                <div class="am-form-group am-form-icon">
                    <i class="am-icon-lock"></i>
                    <input type="password" ref="password" class="myapp-login-input-text am-form-field" placeholder="至少6个字符">
                </div>
            </fieldset>
            <button type="submit" class="myapp-login-form-submit am-btn am-btn-primary am-btn-block " @click="login">登 陆</button>
            <button type="submit" class="myapp-login-form-submit am-btn am-btn-primary am-btn-block " ><a href="registered">注册</a></button>
    </div>
    <div class="am-text-center am-u-sm-11 am-u-sm-centered myapp-login-form-shortcut">
        <hr class="myapp-login-form-hr" />
        <span class="myapp-login-form-hr-font">第三方登陆</span>
    </div>

    <div class="am-u-sm-12 am-text-center myapp-login-form-listico" >
        <div class="am-u-sm-4 am-text-center" >
            <i class="am-icon-btn am-primary am-icon-qq"></i>
        </div>
        <div class="am-u-sm-4 am-text-center" >
            <i class="am-icon-btn am-danger am-icon-weibo"></i>
        </div>
        <div class="am-u-sm-4 am-text-center" >
            <i class="am-icon-btn am-success am-icon-weixin"></i>
        </div>
    </div>

</div>
<div
        class="am-slider am-slider-default"
        data-am-flexslider="{controlNav: 'thumbnails', directionNav: false, slideshow: false}">
    <ul class="am-slides">
        <li data-thumb="http://s.amazeui.org/media/i/demos/pure-4.jpg?imageView2/0/w/360">
            <img src="http://s.amazeui.org/media/i/demos/pure-4.jpg" /></li>
    </ul>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/amazeui.min.js"></script>
<script src="js/app2.js"></script>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.staticfile.org/vue/2.2.2/vue.min.js"></script>
<script src="https://cdn.bootcss.com/axios/0.17.1/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script>
    Vue.config.devtools = true;
        new Vue({
            el:'#box',
            data:{
                email:null,
                password:null,
            },
            methods:{
                login:function () {
                    axios
                        .post('http://www.larxwc.com/api/login',{
                            email:this.$refs.email.value,
                            password:this.$refs.password.value
                        })
                        .then(function (response) {
                            var res = response.data[0]

                            console.log(res);
                            if (res.status_code == 200)
                            {
                                Cookies.set('token',res.token, { expires: 7, path: '' });
                                location.href = "index89";
                            }else {
                                return false;
                            }
                        })
                        .catch(function (error) {//请求失败处理
                            console.log(error)
                        });
                }
            }
        })

</script>
</body>
</html>