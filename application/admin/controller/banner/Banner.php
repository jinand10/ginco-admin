<?php

namespace app\admin\controller\banner;

use app\common\controller\Backend;

/**
 * 轮播图管理
 *
 * @icon fa fa-users
 */
class Banner extends Backend
{

    /**
     * @var \app\admin\model\UserGroup
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('ApiBanner');
        $moduleList = [
            'home_page'     => '首页',
            'hotel_list'    => '酒店列表',
            'hotel_info'    => '酒店详情',
            'service'       => '服务',
            'article_list'  => '文章列表',
            'article_info'  => '文章详情',
            'music_album'   => '音乐专辑',
        ];
        $articleList = model('ApiArticle')->where([
            "is_show" => 1,
            'status' => 1,
        ])->column('title', 'id');
        $base = ['0' => '无'];
        $articleList = $base+$articleList;
        $this->view->assign('moduleList', $moduleList);
        $this->view->assign('articleList', $articleList);
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
}
