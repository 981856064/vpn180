<?php

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;
use Workerman\Lib\Timer;
require('getGatewayData.php');
use GatewayData\GetData;//引用命名空间\类名
/**
 * websocket主逻辑
 */
class Events
{

    function getData($fileId){
        $get_data = new GetData();
        return $get_data->getUserGatewayData($fileId);
    }

    /**
     * 当客户端连接时触发
     * @param $client_id 连接id
     * @throws Exception
     */
    public static function onConnect($client_id)
    {
        echo $client_id."login....\r\n";
    }

    /**
     * 当客户端发来消息时触发
     * @param $client_id 连接id
     * @param $message 具体消息
     * @throws Exception
     */
   public static function onMessage($client_id, $message)
   {

       $array = json_decode($message, true);
       //根据页面请求的不同绑定uid
       switch ($array["request"]){
           case Constant::GET_SHOW_VISITORS:
               Gateway::bindUid($client_id, $array["request"].$array["id"]);
            break;
           case Constant::GET_CHANNEL:
               Gateway::bindUid($client_id, $array["request"].$array["id"]);
               break;
           default:

       }
//       echo var_export(Gateway::getClientIdByUid($array["request"].$array["id"]));

//       $myClass = new Events();
//       $file_data = $myClass->getData($array["id"]);
//       $php_data = $file_data["php"];
//       Gateway::sendToAll(json_encode($php_data));

   }

    /**
     * 当用户断开连接时触发
     * @param $client_id 连接id
     * @throws Exception
     */
   public static function onClose($client_id)
   {
       echo $client_id.">>logout\r\n";
   }

    /**
     * 进程启动时开启定时器
     */
    public static function onWorkerStart()
    {
        Timer::add(1, function(){
            $events = new Events();
            //获取挂载的网关设备
            $get_data = new GetData();
            $vpn_array = $get_data->getVPN();
            $test = null;
            //遍历集合
            foreach($vpn_array as $value){
                //阅读文件，获取数据
                $file_data = $events->getData($value);
//                echo json_encode($file_data["log"]);
                //分析数据，发送信息
                $test = $get_data->getShowVisitor($file_data);
                echo $test;
                if ($test==null){
                    return;
                }
                Gateway::sendToUid( Constant::GET_SHOW_VISITORS.$value,  $test);
            }
//            $json_string = json_encode($vpn_array, JSON_UNESCAPED_UNICODE);
        });
    }
}
