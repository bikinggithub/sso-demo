<?php
session_start();
$redirect_url = empty($_REQUEST['redirect_url'])?'':$_REQUEST['redirect_url'];
if(empty($redirect_url)){
    exit('请求地址异常');
}
if(empty($_SESSION['sso_user'])){
    //未登陆，重定向登陆页
    header('location:'.$redirect_url.'/login.php');
}else{
    //已经登陆成功
    $token = session_id();
    header('location:'.$redirect_url.'/token.php?token='.$token);
}



