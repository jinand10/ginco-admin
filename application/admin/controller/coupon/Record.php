<?php

namespace app\admin\controller\coupon;

use app\common\controller\Backend;

/**
 * 优惠券记录
 *
 * @icon fa fa-users
 */
class Record extends Backend
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

    public function hotels()
    {
        $hotelIds = db('api_user_coupon')->where('verify_hotel_id', '>', 0)->column('verify_hotel_id');
        $kv = db('api_hotel')->where('status', 1)->whereIn('id', $hotelIds)->column('name', 'id');
        return json($kv);
    }

    public function users()
    {
        $userIds = db('api_user_coupon')->where('uid', '>', 0)->column('uid');
        $kv = db('api_user')->where('status', 1)->whereIn('id', $userIds)->column('wechat_nickname', 'id');
        if ($kv) {
            foreach ($kv as &$item) {
                $item = base64_decode($item);
            }
            unset($item);
        }
        return json($kv);
    }

    public function coupons()
    {
        $couponIds = db('api_user_coupon')->where('coupon_id', '>', 0)->column('coupon_id');
        $kv = db('api_coupon')->where('status', 1)->whereIn('id', $couponIds)->column('title', 'id');
        return json($kv);
    }
}
