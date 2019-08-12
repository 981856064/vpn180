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
    }
}