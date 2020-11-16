<?php

namespace app\admin\controller\music;

use app\common\controller\Backend;

/**
 * 音乐列表
 *
 * @icon fa fa-users
 */
class Music extends Backend
{

    /**
     * @var \app\admin\model\UserGroup
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('ApiMusic');
        $albumList = model('ApiMusicAlbum')->where([
            'status' => 1,
        ])->column('title', 'id');
        $this->view->assign('albumList', $albumList);
    }
    /**
     * 查看
     */
    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->where($where)
                ->count();
            $list = $this->model
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    public function album()
    {
        return json(model('ApiMusicAlbum')->where([
            'status' => 1,
        ])->column('title', 'id'));
    } 
}
