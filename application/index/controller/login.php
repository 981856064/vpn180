<?php
/**
 * Date: 2019/7/9
 * Time: 14:43
 */

$username=$_POST['title'];
$password=$_POST['password'];
//密码md5加密验证
$md5=md5($password);
$md5_to_md5=md5($md5.'vpn180');
if ($username=="admin"&&$md5_to_md5=="6a7829c33b9209fd0ae1723e25001c36"){
    echo true;
}else{
    echo false;
}
