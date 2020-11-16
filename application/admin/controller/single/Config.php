<?php

namespace app\admin\controller\single;

use app\common\controller\Backend;
use app\common\model\Config as ConfigModel;
use think\Db;

/**
 * 单页配置管理
 *
 * @icon fa fa-users
 */
class Config extends Backend
{

    /**
     * @var \app\admin\model\UserGroup
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('ApiConfig');
    }
    /**
     * 查看
     */
    public function index()
    {
        $data = $this->model->column(null, 'type');
        $siteList = [
            'brand' => [
                'name'  => 'brand',
                'title' => __('Brand preview'),
                'type'  => 1,
                'list'  => [
                    [
                        'id'    => 1,
                        'name'  => 'content',
                        'group' => 'brand',
                        'title' => __('Content'),
                        'tip'   => '请填写内容',
                        'type'  => 'editor',
                        'value' => $data[1]['content'] ?? '',
                        'content' => '',
                        'rule' => 'required',
                        'extend' => '',
                    ],
                    [
                        'id'    => 2,
                        'name'  => 'english_content',
                        'group' => 'brand',
                        'title' => __('EnglishContent'),
                        'tip'   => '请填写英文内容',
                        'type'  => 'editor',
                        'value' => $data[1]['english_content'] ?? '',
                        'content' => '',
                        'rule' => 'required',
                        'extend' => '',
                    ],
                ],
                'active' => 1,
            ],
            'law' => [
                'name'  => 'law',
                'title' => __('Legal provisions'),
                'type'  => 2,
                'list'  => [
                    [
                        'id'    => 1,
                        'name'  => 'content',
                        'group' => 'law',
                        'title' => __('Content'),
                        'tip'   => '请填写内容',
                        'type'  => 'editor',
                        'value' => $data[2]['content'] ?? '',
                        'content' => '',
                        'rule' => 'required',
                        'extend' => '',
                    ],
                    [
                        'id'    => 2,
                        'name'  => 'english_content',
                        'group' => 'law',
                        'title' => __('EnglishContent'),
                        'tip'   => '请填写英文内容',
                        'type'  => 'editor',
                        'value' => $data[2]['english_content'] ?? '',
                        'content' => '',
                        'rule' => 'required',
                        'extend' => '',
                    ],
                ],
                'active' => 0,
            ],
            'aboutme' => [
                'name'  => 'aboutme',
                'title' => __('About me'),
                'type'  => 3,
                'list'  => [
                    [
                        'id'    => 1,
                        'name'  => 'content',
                        'group' => 'aboutme',
                        'title' => __('Content'),
                        'tip'   => '请填写内容',
                        'type'  => 'editor',
                        'value' => $data[3]['content'] ?? '',
                        'content' => '',
                        'rule' => 'required',
                        'extend' => '',
                    ],
                    [
                        'id'    => 2,
                        'name'  => 'english_content',
                        'group' => 'aboutme',
                        'title' => __('EnglishContent'),
                        'tip'   => '请填写英文内容',
                        'type'  => 'editor',
                        'value' => $data[3]['english_content'] ?? '',
                        'content' => '',
                        'rule' => 'required',
                        'extend' => '',
                    ],
                ],
                'active' => 0,
            ],
        ];
        $this->view->assign('siteList', $siteList);
        $this->view->assign('typeList', ConfigModel::getTypeList());
        $this->view->assign('ruleList', ConfigModel::getRegexList());
        $this->view->assign('groupList', ConfigModel::getGroupList());
        return $this->view->fetch();
    }

    public function edit($ids = null)
    {
        $params = $this->request->post("row/a");
        if (!$params) {
            $this->error(__('No rows were updated'));
        }
        $id = $this->model->where('type', $params['type'])->value('id');
        try {
            if ($id) {
                $this->model->where('id', $id)->update([
                    'content' => $params['content'],
                    'english_content' => $params['english_content'],
                ]);
            } else {
                $this->model->insert([
                    'type'  => $params['type'],
                    'content' => $params['content'],
                    'english_content' => $params['english_content'],
                ]);
            }
            //$result = Db::execute("insert into ginco_api_config(`type`, `content`, `english_content`) values({$params['type']}, '{$params['content']}', '{$params['english_content']}') on duplicate key update `content` = '{$params['content']}', `english_content` = '{$params['english_content']}'");
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        $this->success();
    }
}
