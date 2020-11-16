<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Lang;

/**
 * 主页
 * @internal
 */
class Index extends Frontend
{

    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];
    protected $layout = '';
    
    public function index()
    {
        return $this->view->fetch();
    }

}
