<?php

namespace app\admin\model;

use think\Model;

class ApiMusicAlbum extends Model
{
    // 表名
    protected $name = 'api_music_album';
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

}
