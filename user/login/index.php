<?
require_once('../../var/database.php');
require_once('../fun.php');
islogin();
$con=mysqli_connect($servername,$username,$password,$dbname);
if (mysqli_connect_error()) {
    echo("网站出现了错误请联系管理员修复");
    exit();
}
if (!empty($_POST['email']) and !empty($_POST['pass'])) {
    if (preg_match_all('/\b[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,6}\b/', $_POST['email'])===1) {
        $cloud=$con->query("SELECT * FROM user WHERE email='".$_POST['email']."'");
        if ($cloud->num_rows == 1) {
            $cloud=$cloud->fetch_array();
            if ($cloud['pass']==$_POST['pass']) {
                setcookie("user",$cloud['email'],time()+60*60*24*7,'/');
                setcookie("usersign",strjia($cloud['email']),time()+60*60*24*7,'/');
                setcookie("pass",$cloud['pass'],time()+60*60*24*7,'/');
                setcookie("passsign",strjia($cloud['pass']),time()+60*60*24*7,'/');
                $url = $_SERVER['REMOTE_HOST']."/index.php";  
                echo "<script type='text/javascript'>";  
                echo "window.location.href='$url'";  
                echo "</script>";
                exit;
            }else{
                $stu='password';
            }
        }else{
            $stu='mei';
        }
    } else {
        $stu='email';
    }
    
}
?>
<html>
    <head>
        <title>
            <?
            require('../../var/site.php');
            echo 'PanDownload - '.$name.' - Login';
            ?>
        </title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="description" content="<?
        require_once('../../var/site.php');
        echo 'PanDownload - '.$name.' - Login';
        ?>">
        <meta name="keywords" content="pan,PanDownload,网盘,网盘下载,网盘直链,网盘提速">
        <!--ts-->
        <style>
            body {
                background-image: url(/img/bj1.png);
                background-position: center center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                background-color: #464646;
            }
            .use-flexbox{
                display:flex;
                align-items:center;
                justify-content:center;
                border:1px solid #000;
            }
            @font-face {
                font-family: Minecraft;
                src: url(data:font/woff2;base64,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) format("woff2"),url(data:font/woff;base64,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) format("woff")
            }
            .font-mc{
                font-family: Minecraft;
            }
        </style>
        <!--import yaou ui css-->
        <link rel="stylesheet" href="https://yaou.pro/css/index.css"
        <!--import mdui css -->
        <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css"/>
        <link rel="stylesheet" href="http://ip.yaou.pro/js/tan/layx.min.new.css"/>
    </head>
    <body>
        <script src="/js/tan/layx.min.new.js"></script>
        <!--head-->
        <div class="mdui-appbar mdui-color-transparent">
            <div class="mdui-toolbar mdui-color-transparent">
                <!--title-->
                <a href="javascript:;" class="mdui-typo-headline font-mc">PanDownload - <?
                require_once('../../var/site.php');
                echo($name.' - Login');
                ?></a>
                <div class="mdui-toolbar-spacer"></div>
                <!--refresh btn-->
                <a href="#" class="mdui-btn mdui-btn-icon">
                    <i class="mdui-icon material-icons">refresh</i>
                </a>
            </div>
        </div>
        <div class="use-flexbox" style="weight:100%;height:100%;text-align: center;">
            <div style="text-align: center">
                <h1 class="font-mc" style="text-align:center">Login</h1>
                <!--menu-->
                <div class="mdui-card" style="background-color: rgba(255,255,255,0.5);">
                    <div class="mdui-card-content">
                        <form action="/user/login/index.php" method="post" style="text-align: left">
                            <!--Email-->
                            <div class="mdui-textfield mdui-textfield-floating-label">
                                <label class="mdui-textfield-label">邮箱</label>
                                <input class="mdui-textfield-input" type="email" name="email" required/>
                                <div class="mdui-textfield-error">邮箱不能为空，且必须为邮箱格式</div>
                            </div>
                            <!--Password-->
                            <div class="mdui-textfield mdui-textfield-floating-label">
                                <label class="mdui-textfield-label">密码</label>
                                <input class="mdui-textfield-input" type="password" name="pass" required/>
                                <div class="mdui-textfield-error">密码不能为空</div>
                            </div>
                            <!--login btn-->
                            <div style="text-align:center;">
                                <input type="submit" class="mdui-btn mdui-btn-raised mdui-ripple" style="background-color: rgba(255,255,255,0.7)" value="登录"/>
                                <div class="mdui-typo">
                                    <p>没有账号?<a href="/user/regin/">点我注册</a></p>
                                </div>
                                <p class="mdui-color-red"><?
                                if (!empty($stu)) {
                                    switch ($stu) {
                                        case 'email':
                                            echo('邮箱格式不正确');
                                            break;
                                        case 'mei':
                                            echo('没有此用户');
                                            break;
                                        case 'password':
                                            echo('密码错误');
                                            break;
                                        default:
                                            echo('发生了意想不到的错误');
                                            break;
                                    }
                                }
                                ?></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--import mdui js-->
        <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
    </body>
</html>