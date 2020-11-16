define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'coupon/coupon/index',
                    add_url: 'coupon/coupon/add',
                    edit_url: 'coupon/coupon/edit',
                    del_url: 'coupon/coupon/del',
                    multi_url: 'coupon/coupon/multi',
                    table: 'ginco_api_coupon',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'ginco_api_coupon.id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id'), sortable: true},
                        {field: 'title', title: __('Title')},
                        {field: 'english_title', title: __('EnglishTitle')},
                        {field: 'desc', title: __('Desc'), operate: false},
                        {field: 'english_desc', title: __('EnglishDesc'),  operate: false},
                        {field: 'valid_time', title: __('valid_time'),  operate: false},
                        {field: 'english_valid_time', title: __('english_valid_time'),  operate: false},
                        {field: 'price', title: __('price'),  operate: false},
                        {field: 'create_time', title: __('Create time'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        {field: 'update_time', title: __('Update time'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
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