<?php

namespace app\admin\controller\article;

use app\common\controller\Backend;

/**
 * 文章分类
 *
 * @icon fa fa-users
 */
class Type extends Backend
{

    /**
     * @var \app\admin\model\UserGroup
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('ApiArticleType');
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

    public function del($ids = "")
    {
        foreach (explode(',', $ids) as $id) {
            if (model('ApiArticle')->where('article_type_id', $id)->column('id')) {
                $this->error("ID: {$id} ".__('There are articles under this category, which cannot be deleted'));
            }
        }
        return parent::del($ids);
    }
}
