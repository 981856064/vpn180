<?php
/**
 * 获取网关数据
 */
namespace GatewayData{
    class GetData{
        var $data_array ;

        /**
         * 读取log\php\vpn文件数据
         * @param $fileId
         * @return array
         */
        function getUserGatewayData($fileId){
            $file_path = 'E:/a/';
            $path =$file_path."php".$fileId;
            if(file_exists($path)){
                //log文件
                $log_file = fopen($file_path."log".$fileId, "r");
                $read_log=fread($log_file,180);
                fclose($log_file);
                $log_data=unpack("C*",$read_log);

                //php文件
                $php_file = fopen($file_path."php".$fileId, "r");
                $read_php=fread($php_file,180);
                fclose($php_file);
                $php_data=unpack("C*",$read_php);
                $array =array(
                    "log"=>$log_data,
                    "php"=>$php_data,
                );
                return $array;
            }
        }

        /**
         * 获取挂载的网关 >=50100
         * @return array
         */
        function getVPN(){
            $vpnArray = array();
            //$path = "../../dev/vhfvoip";
            $path = "E:/a/vhfvoip";
            //打开目录
            $handler = opendir($path);
            //遍历目录下的所有文件
            while( ($filename = readdir($handler)) !== false ) {
                //目录下都会有两个文件，名字为’.'和‘..’，不进行操作
                if($filename != "." && $filename != ".."){
                    if(strpos($filename,'vpn') !==false && $this->findNum($filename)>=50100) {
                        $vpn = $this->findNum($filename);
                        //添加元素
                        array_push($vpnArray, $vpn);
                    }
                }
            }
            closedir($handler);
            return $vpnArray;
        }

        //提取数字
         function findNum($str){
            $sum = preg_replace('/[^\d]*/', '', $str);
            return $sum;
        }

        /**
         * 分析数据
         * @param $file_array
         * @return
         */
        function getShowVisitor($file_array){
            if ($file_array["log"]!=null){
                $log =  $file_array["log"];
                //ip
                $ip = $log[1].".$log[2]".".$log[3]".".$log[4]";
                $et0_ip = $log[39].".$log[40]".".$log[41]".".$log[42]";
                $et1_ip = $log[45].".$log[46]".".$log[47]".".$log[48]";

                //电源实时温度
                $temperature = $log[61];

                //总线实时电压、电流
                $total_line_voltage = $log[62];
                $total_line_current = $log[63];

                //ATOM实时电压、电流
                $atom_voltage = $log[64];
                $atom_current = $log[65];

                //收发信机实时电压、电流
                $transceiver_voltage = $log[66];
                $transceiver_current = $log[67];

                //

                return $ip;
            }else{
                return null;
            }
        }

        //test测试
        public function testJson(){

            $data_array = array(
                "id"=>"001",
                "state"=>"0", //0-正常，1-异常
                "name"=>"基站-z",
                "output"=>"1", //0-未开启，1-开始输出
                "output_dBmw"=>"66", //输出（上传）电平值
                "input"=>"0", //0-未开启，1-开始输入
                "input_dBmw"=>"00", //输入（接收）电平值
            );
            $data_array2 = array(
                "id"=>"001",
                "state"=>"0", //0-正常，1-异常
                "name"=>"基站-f",
                "output"=>"0", //0-未开启，1-开始输出
                "output_dBmw"=>"00", //输出（上传）电平值
                "input"=>"1", //0-未开启，1-开始输入
                "input_dBmw"=>"66", //输入（接收）电平值
            );
            $wifi_array = array(
                "id" =>"002",
                "name"=>"WIFI-1",
                "state"=>"0", //0-正常，1-异常
                "data1"=>"000",
                "data2"=>"000",
                "data3"=>"000",
                "data4"=>"000",
            );
            $base_station_array = array(
            );
            for ($i=0;$i<3;$i++){
                $base_station_array[$i] = array(
                    "main"=>array(
                        "id"=>"001",
                        "state"=>"0", //0-正常，1-异常
                        "name"=>"基站-".$i,
                        "output"=>"1", //0-未开启，1-开始输出
                        "output_dBmw"=>"66", //输出（上传）电平值
                        "input"=>"0", //0-未开启，1-开始输入
                        "input_dBmw"=>"00", //输入（接收）电平值
                    ),
                    "vice"=>array(
                        "id"=>"001",
                        "state"=>"0", //0-正常，1-异常
                        "name"=>"基站-f".$i,
                        "output"=>"0", //0-未开启，1-开始输出
                        "output_dBmw"=>"00", //输出（上传）电平值
                        "input"=>"1", //0-未开启，1-开始输入
                        "input_dBmw"=>"66", //输入（接收）电平值
                    ),
                    "wifi"=>array(
                        "id" =>"002",
                        "name"=>"WIFI-".$i,
                        "state"=>"0", //0-正常，1-异常
                        "data1"=>"00".$i,
                        "data2"=>"000".$i,
                        "data3"=>"000".$i,
                        "data4"=>"000".$i,
                    )
                );
            }
            $seat_data_array = array(
                "id" =>"01",
                "name"=>"坐席-01",
                "state"=>"0", //0-正常，1-异常
                "output"=>"0", //0-未开启，1-开始输出
                "output_dBmw"=>"00", //输出（上传）电平值
                "input"=>"1", //0-未开启，1-开始输入
                "input_dBmw"=>"66", //输入（接收）电平值
                "base_station"=>$base_station_array
            );
            $seat_array = array();
            for ($i=0;$i<3;$i++){
                $seat_array[$i]=$seat_data_array;
            }
            $json_string = json_encode($seat_array, JSON_UNESCAPED_UNICODE);
            return $json_string;
        }
    }
}