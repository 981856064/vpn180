<?php
// 声明命名空间
namespace app\index\controller;
// 声明控制器
class User{
    // 声明方法
    public function index(){
        return "我是User控制器下的index方法";
    }
    public function add_template(){
        return view();
    }
    public function initialCheck(){
        return true;
    }
    public function initialize_settings(){
        return view();
    }
    public function getSeat(){
        $seat ='{
	    "code": 0,
	    "msg": "",
        "count": 2,
	    "data": [{
		    "id": 10000,
		    "username": "admin",
		    "seat_name": "坐席1",
		    "id_ch": "50010-1|50010-2",
		    "create_time": "2019-9-10 9:00:00",
		    "update_time": "2019-9-10 9:00:00",
		    "note":0
	        },{
		    "id": 10001,
		    "username": "admin",
		    "seat_name": "坐席2",
		    "id_ch": "50010-1|50010-2",
		    "create_time": "2019-9-10 9:00:00",
		    "update_time": "2019-9-10 9:00:00",
		    "note":1
	        }]
        }';
        echo $seat;
    }

    public function getTemplates(){
        $str = '{
	    "code": 0,
	    "msg": "",
        "count": 2,
	    "data": [{
		    "id": 10000,
		    "name": "白天模板",
		    "userName": "admin",
		    "seatName": "坐席1|坐席2",
		    "idCh": "50010-1",
		    "create_time": "2019-9-10 9:00:00",
		    "update_time": "2019-9-10 9:00:00",
		    "note":0
	        },{
		    "id": 10001,
		    "name": "夜间模板",
		    "userName": "admin",
		    "seatName": "坐席1",
		    "idCh": "50010-1",
		    "create_time": "2019-9-10 9:00:00",
		    "update_time": "2019-9-10 9:00:00",
		    "note":1
	    }]
    }';
        echo $str;
    }
}