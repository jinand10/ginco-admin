define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'apiuser/apiuser/index',
                    table: 'ginco_api_user',
                }
            });

            var table = $("#table");

            var gender = {
                "1": "男",
                "2": "女"
            };
            var isAdmin = {
                "0": "否",
                "1": "是"
            };

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'ginco_api_user.id',
                columns: [
                    [
                        //{checkbox: true},
                        {field: 'id', title: __('Id'), sortable: true},
                        // {field: 'name', title: __('Name')},
                        // {field: 'phone', title: __('Phone')},
                        // {field: 'email', title: __('Email')},
                        {field: 'wechat_nickname', title: __('WechatNickname')},
                        {field: 'wechat_avatar', title: __('WechatAvatar'), events: Table.api.events.image, formatter: Table.api.formatter.image, operate: false},
                        {field: 'country', title: __('Country')},
                        {field: 'province', title: __('Province')},
                        {field: 'city', title: __('City')},
                        {field: 'gender', title: __('Gender'), searchList: gender, formatter: function (value, row) {
                            return gender[value];
                        }},
                        {field: 'is_admin', title: __('isAdmin'), searchList: isAdmin, formatter: function (value, row) {
                            return isAdmin[value];
                        }},
                        {field: 'create_time', title: __('Create time'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
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