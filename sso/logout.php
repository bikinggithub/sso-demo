<?php
session_start();
$redirect_url = empty($_REQUEST['redirect_url'])?'':$_REQUEST['redirect_url'];
if(empty($redirect_url)){
    exit('请求地址异常');
}
require_once __DIR__.'/common.php';
$config = require(__DIR__.'/config.php');
if(!empty($config['domain_list'])){
    $flag = true;
    foreach($config['domain_list'] as $k=>$v){
        $data = send($v.'/logout.php',['token'=>session_id()]);
        $data_json = json_decode($data,true);
        if(empty($data_json) || $data_json['code'] != '200'){
            $flag = false;
            break;
        }
    }
    if($flag){
        session_destroy();
    }
}else{
    session_destroy();
}

header('location:'.$redirect_url.'/index.php');


