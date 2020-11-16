<?php

namespace app\admin\controller\article;

use app\common\controller\Backend;

/**
 * 文章管理
 *
 * @icon fa fa-users
 */
class Article extends Backend
{

    /**
     * @var \app\admin\model\UserGroup
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('ApiArticle');
        $articleTypeList = model('ApiArticleType')->where([
            'status' => 1,
        ])->column('name', 'id');
        $couponList = model('ApiCoupon')->where([
            'status' => 1,
        ])->column('title', 'id');
        $this->view->assign('articleTypeList', $articleTypeList);
        $this->view->assign('couponList', ([0 => '不包含优惠券'])+$couponList);
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

    public function type()
    {
        return json(model('ApiArticleType')->where([
            'status' => 1,
        ])->column('name', 'id'));
    }
}
