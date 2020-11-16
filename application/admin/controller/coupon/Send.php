<?php

namespace app\admin\controller\coupon;

use app\common\controller\Backend;
use app\common\model\Config as ConfigModel;
use think\Db;

/**
 * 优惠券发送
 *
 * @icon fa fa-users
 */
class Send extends Backend
{

    /**
     * @var \app\admin\model\UserGroup
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('ApiUserCoupon');
    }
    /**
     * 查看
     */
    public function index()
    {
        $users = db('api_user')->where('status', 1)->column('wechat_nickname', 'id');
        if ($users) {
            foreach ($users as &$item) {
                $item = base64_decode($item);
            }
            unset($item);
        }
        $coupons = db('api_coupon')->where('status', 1)->column('title', 'id');

        $siteList = [
            'send' => [
                'name'  => 'send',
                'title' => __('Designated user send'),
                'type'  => 1,
                'list'  => [
                    [
                        'id'    => 1,
                        'name'  => 'uid',
                        'group' => 'send',
                        'title' => __('Wait send User'),
                        'tip'   => '请选择发送用户',
                        'type'  => 'selects',
                        'value' => key($users),
                        'content' => $users,
                        'rule' => 'required',
                        'extend' => '',
                    ],
                    [
                        'id'    => 2,
                        'name'  => 'coupon_id',
                        'group' => 'send',
                        'title' => __('Wait send Coupon'),
                        'tip'   => '请选择发送优惠券',
                        'type'  => 'select',
                        'value' => key($coupons),
                        'content' => $coupons,
                        'rule' => 'required',
                        'extend' => '',
                    ],
                ],
                'active' => 1,
            ],
            'full_send' => [
                'name'  => 'full_send',
                'title' => __('Full user send'),
                'type'  => 2,
                'list'  => [
                    [
                        'id'    => 1,
                        'name'  => 'coupon_id',
                        'group' => 'send',
                        'title' => __('Wait send Coupon'),
                        'tip'   => '请选择发送优惠券',
                        'type'  => 'select',
                        'value' => key($coupons),
                        'content' => $coupons,
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
        $time = time();
        try {
            if ($params['type'] == 1) {
                //指定用户发送
                $insert = [];
                foreach ($params['uid'] as $uid) {
                    if (!$uid) {
                        $this->error(__('User not empty'));
                    }
                    $insert[] = [
                        'uid'           => $uid,
                        'coupon_id'     => $params['coupon_id'],
                        'create_time'   => $time,
                        'update_time'   => $time,
                    ];
                }
                $this->model->insertAll($insert);
            } else if ($params['type'] == 2) {
                //全量用户发送
                $users = db('api_user')->where('status', 1)->column('id');
                if (!$users) {
                    $this->error('暂无用户');
                }
                foreach ($users as $uid) {
                    $insert[] = [
                        'uid'           => $uid,
                        'coupon_id'     => $params['coupon_id'],
                        'create_time'   => $time,
                        'update_time'   => $time,
                    ];
                }
                $this->model->insertAll($insert);
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        $this->success();
    }
}
