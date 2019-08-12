<?php
/**
 * Date: 2019/7/24
 * Time: 15:07
 */

$vpnArray = array();
//$path = "../../dev/vhfvoip";
$path = "E:/a/vhfvoip";
//打开要操作的目录，并用一个变量指向它
$handler = opendir($path);
//循环的读取目录下的所有文件
while( ($filename = readdir($handler)) !== false ) {
    //目录下都会有两个文件，名字为’.'和‘..’，不进行操作
    if($filename != "." && $filename != ".."){
        if(strpos($filename,'vpn') !==false && findNum($filename)>=50100) {
            $Array = array(
                "id"=> findNum($filename),
                "state"=>"正常运行",
                "name" => $filename,
            );
            $vpnArray[] = $Array;
        }
    }
}

closedir($handler);
$array = array(
    "code" => "0",
    "mag"=> null,
    "count"=> count($vpnArray),
    "data"=>$vpnArray,
    "error"=>"未知错误",
);

echo json_encode($array );

//提取数字
function findNum($str){
    $sum = preg_replace('/[^\d]*/', '', $str);
    return $sum;
}