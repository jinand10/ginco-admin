define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var hotelList;
    $.ajax({
        url: "coupon/record/hotels",
        async: false,
        success: function (data) {
            hotelList = data;
        },
    });
    var couponList;
    $.ajax({
        url: "coupon/record/coupons",
        async: false,
        success: function (data) {
            couponList = data;
        },
    });
    var userList;
    $.ajax({
        url: "coupon/record/users",
        async: false,
        success: function (data) {
            userList = data;
        },
    });
    
    var isUseList = {
        "1": "是",
        "0": "否"
    };


    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'coupon/record/index',
                    // add_url: 'coupon/record/add',
                    // edit_url: 'coupon/record/edit',
                    del_url: 'coupon/record/del',
                    // multi_url: 'coupon/record/multi',
                    table: 'ginco_api_user_coupon',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'ginco_api_user_coupon.id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'uid', title: __('Uid'), searchList: userList, formatter: function (value, row) {
                            return userList[value];
                        }},
                        {field: 'coupon_id', title: __('Coupon'), searchList: couponList, formatter: function (value, row) {
                            return couponList[value];
                        }},
                        {field: 'is_use', title: __('IsUse'), searchList: isUseList, formatter: function (value, row) {
                            return isUseList[value];
                        }},
                        {field: 'verify_hotel_id', title: __('Verify Hotel'), searchList: hotelList, formatter: function (value, row) {
                            return hotelList[value];
                        }},
                        {field: 'verify_time', title: __('Verify time'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        {field: 'create_time', title: __('Create time'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});