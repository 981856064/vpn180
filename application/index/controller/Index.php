<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\index\model\User as UserModel;

/**
 * 前台控制器
 * Class Index
 * @package app\index\controller
 */
class Index extends Controller
{
    /**
     * 返回视图 index
     * @return \think\response\View
     */
    public function index(){
        return view();
    }

    /**
     * 返回视图 layui
     * @return \think\response\View
     */
    public function layui(){
        return view();
    }

    /**
     * 返回视图 seat
     * @return \think\response\View
     */
    public function seat(){
        return view();
    }

    /**
     * 返回视图 assistant
     * @return \think\response\View
     */
    public function assistant(){
        return view();
    }

    /**
     * 返回视图 registered
     * @return \think\response\View
     */
    public function registered(){
        return view();
    }

    /**
     * 返回视图 log_bounced
     * @return \think\response\View
     */
    public function log_bounced(){
        return view();
    }

    /**
     * 返回视图 very_sorry
     * @return \think\response\View
     */
    public function very_sorry(){
        return view();
    }

    /**
     * 返回视图 detail_data
     * @return \think\response\View
     */
    public function detail_data(){
        return view();
    }

    /**
     * 测试数据：坐席
     * @return array
     */
    function getVPN(){
        $data='{"code":"0","mag":null,"count":4,"data":[{"id":"50100","state":"正常","audioInput":"正常","audioOutput":"正常","name":"vpn50103"},{"id":"50101","name":"vpn50103","state":"出现异常","audioInput":"正常","audioOutput":"正常"},{"id":"50102","name":"vpn50103","state":"正常","audioInput":"正常","audioOutput":"正常"},{"id":"50104","name":"vpn50103","state":"正常","audioInput":"正常","audioOutput":"正常"}],"error":"\u672a\u77e5\u9519\u8bef"}';
        echo $data;
    }

    /**
     * getVPN 调用该方法 提取数字
     * @param $str
     * @return null|string|string[]
     */
    private function findNum($str){
        $sum = preg_replace('/[^\d]*/', '', $str);
        return $sum;
    }

    /**
     * 用户注册
     * @param Request $request
     */
    public function registeredUser(Request $request){

        $username =  $request->param('user');
        $password =$request->param('password');
        $user_array = Db::query('select * from user');

        //验证用户名是否已经被注册
        foreach ($user_array as $value){
            if ($username ==$value['name']) {
                 $this->error("账号已经被注册，请重新更换账号", true);
                 return;
            }
        }

        //新增用户
        $user= new UserModel;
        $user->name = $username;
        $user->email = $request->param('email');
        $user->password = md5($password."vpn180");
        $user->department = $request->param('department');
        $user->cell_phone = $request->param('phone');
        if ($user->save()) {
            $this->success("账号注册成功", true);
        } else {
            $this->error($user->getError(), true);
        }
    }

    /**
     * 获取本地服务器时间
     * @return string = 00:00:00 星期 *
     */
    public function getTime(){
        $weekarray=array("日","一","二","三","四","五","六");
        date_default_timezone_set('PRC');
        return date('H:i:s'). "  星期".$weekarray[date("w")];
    }

}