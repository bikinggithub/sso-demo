<?php
$session_id = session_id();
session_start();

require_once __DIR__.'/config.php';
if(empty($_SESSION['user_info'])){
    if(empty($session_id)){
        header('location:http://'.SSODOMAIN.'/index.php?redirect_url='.SITEDOMAIN);
    }
}else{
?>
    <div>
        <p>
            登陆B成功，欢迎你！<?php echo $_SESSION['user_info']['username']; ?>
            <a href="<?php echo 'http://'.SSODOMAIN.'/logout.php?redirect_url='.SITEDOMAIN; ?>" style="color:#ff0000;">退出登陆</a>
        </p>
    </div>
<?php
}
?>
