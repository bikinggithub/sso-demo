<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/common.php';
if(empty($_REQUEST['token'])){
    header('location:'.SITEDOMAIN.'/login.php');
}else{
    $token = $_REQUEST['token'];
    $data = send('http://'.SSODOMAIN.'/check.php',['token'=>$token]);
    $json_data = json_decode($data,true);
    if(!empty($json_data) && $json_data['code'] == '200'){
        session_id(md5(SITEDOMAIN.$token));
        session_start();

        $_SESSION['user_info'] = $json_data['data'];
        header('location:'.SITEDOMAIN.'/index.php');
        exit;
    }else{
        header('location:'.SITEDOMAIN.'/login.php?msg='.$json_data['msg']);
        exit();
    }
}