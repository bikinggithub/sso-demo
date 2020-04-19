<?php
session_start();
require_once __DIR__.'/config.php';
//判断，如果已经登陆，则不需要该登陆页面
if(!empty($_SESSION['user_info'])){
    header('location:'.SITEDOMAIN.'/index.php');
    exit;
}
$msg = empty($_REQUEST['msg'])?'':$_REQUEST['msg'];
if(!empty($_POST)){
    header('location:http://'.SSODOMAIN.'/login.php?redirect_url='.SITEDOMAIN.'&username='.urlencode($_POST['username']).'&password='.urlencode($_POST['password']));
    exit;
}
?>
<html>
    <head>
        <title>系统A登陆页</title>
    </head>
    <body>
        <div style="width:50%;margin:50px auto;border:1px solid #ccc;padding:20px;">
            <h3 style="text-align:center;">系统A登陆</h3>
            <form action="/login.php" method="POST">
                <p>账号：<input type="text" name="username" /></p>
                <p>密码：<input type="password" name="password" /></p>
                <button type="submit">登陆</button>
                <button type="reset">重置</button>
                <?php
                    if(!empty($msg)){
                        echo '<p style="color:#ff0000;font-size:12px;">'.$msg.'</p>';
                    }
                ?>
            </form>
        </div>
    </body>
</html>




