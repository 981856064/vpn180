<?php
/**
 * hq
 * Date: 2019/8/13
 * Time: 18:49
 */
namespace app\admin\controller;

use think\Controller;

/**
 * 后台控制器
 * Class Index
 * @package app\index\controller
 */
class Index extends Controller
{
    public function index(){
        return view('layui');
    }



}