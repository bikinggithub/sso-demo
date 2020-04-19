<?php
if(empty($_POST['token'])){
    echo json_encode(['code'=>100,'msg'=>'系统错误10001（缺少参数）']);
    exit();
}
session_id($_POST['token']);
session_start();
if(empty($_SESSION['sso_user'])){
    echo json_encode(['code'=>120,'msg'=>'系统错误10002（未登陆）']);
    exit();
}
//验证通过，返回用户信息
echo json_encode(['code'=>200,'msg'=>'验证成功','data'=>$_SESSION['sso_user']]);
