<?php
session_start();
$redirect_url = empty($_REQUEST['redirect_url'])?'':$_REQUEST['redirect_url'];
if(empty($redirect_url)){
    exit('请求地址异常');
}
//系统用户信息
$sys_user_info = [
    'zhangsan'=>'123456',
    'lisi'=>'123123'
];

$username = empty($_REQUEST['username'])?'':trim(urldecode($_REQUEST['username']));
$password = empty($_REQUEST['password'])?'':trim(urldecode($_REQUEST['password']));
if(empty($username) || empty($_REQUEST['password']) || in_array($username,$sys_user_info) || $sys_user_info[$username] != $password){
    header('location:'.$redirect_url.'/login.php?msg=用户名密码不正确');
    exit;
}

//验证成功，设置登陆信息
$_SESSION['sso_user'] = ['username'=>$username,'password'=>$password];
$token = session_id();
header('location:'.$redirect_url.'/token.php?token='.$token);
exit;


