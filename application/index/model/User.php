<?php
namespace app\index\model;
use think\Model;
class User extends Model{
    // 设置完整的数据表（包含前缀）
    protected $table = 'user';
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
}
