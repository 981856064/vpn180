<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\index\model\User as UserModel;
class Index extends Controller
{
    /**
     * 主页
     * @return \think\response\View
     */
    public function index()
    {
        return view();
    }

    /**
     * layui页面
     * @return \think\response\View
     */
    public function layui()
    {
        return view();
    }

    /**
     * layui页面
     * @return \think\response\View
     */
    public function seat()
    {
        return view();
    }
    public function assistant()
    {
        return view();
    }

    /**
     * 获取挂载的网关 >=50100
     * @return array
     */
    function getVPN(){
        $data='{"code":"0","mag":null,"count":4,"data":[{"id":"50100","state":"正常运行","audioInput":"正常运行","audioOutput":"正常运行","name":"vpn50103"},{"id":"50101","name":"vpn50103","state":"出现异常"},{"id":"50102","name":"vpn50103","state":"正常运行"},{"id":"50104","name":"vpn50103","state":"正常运行"}],"error":"\u672a\u77e5\u9519\u8bef"}';
        echo $data;
    }

    /**
     * getVPN 调用该方法 提取数字
     * @param $str
     * @return null|string|string[]
     */
    public function findNum($str){
        $sum = preg_replace('/[^\d]*/', '', $str);
        return $sum;
    }

    /**
     * 注册页面
     * @return \think\response\View
     */
    public function registered(){
       return view();
    }

    /**
     * 注册页面
     * @return \think\response\View
     */
    public function log_bounced(){
        return view();
    }

    /**
     * 注册用户
     * @param Request $request
     */
    public function registeredUser(Request $request){
        $array = $request->param('user');
        return($array);
    }

        public function very_sorry(){
            return view();
        }

    /**
     * 获取本地服务器时间
     * @return 00:00:00 星期 *
     */
    public function getTime(){
        $weekarray=array("日","一","二","三","四","五","六");
        date_default_timezone_set('PRC');
        return date('H:i:s'). "  星期".$weekarray[date("w")];
    }

    /**
     * 读取MySQL -user表
     */
    public function getUser(){
        $result = Db::query('select * from user');
        dump($result);
    }

    // 新增用户数据
    public function addUser($jsonData){
        $user= new UserModel;
        $user->name = '流年';
        $user->email = 'thinkphp@qq.com ';
        $user->password = '00000';
        if ($user->save()) {
            return '用户[ ' . $user->name . ':' . $user->id . ' ]新增成功';
        } else {
            return $user->getError();
        }
    }

    public function test(Request $request){
        $data = array(
            "data"=>"6666",
            "title"=>"666",
        );
       return $data;
    }
}