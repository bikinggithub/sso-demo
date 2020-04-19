<?php
require_once __DIR__.'/config.php';
$token = $_REQUEST['token'];
session_id(md5(SITEDOMAIN.$token));
session_start();
session_destroy();
echo json_encode(['code'=>200,'msg'=>'退出成功']);
exit();