define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'hotel/hotel/index',
                    add_url: 'hotel/hotel/add',
                    edit_url: 'hotel/hotel/edit',
                    del_url: 'hotel/hotel/del',
                    multi_url: 'hotel/hotel/multi',
                    table: 'ginco_api_hotel',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'ginco_api_hotel.id',
                columns: [
                    [
                        //{checkbox: true},
                        {field: 'id', title: __('Id'), sortable: true},
                        {field: 'name', title: __('Name')},
                        {field: 'english_name', title: __('EnglishName')},
                        {field: 'desc', title: __('Desc'), operate: false},
                        {field: 'english_desc', title: __('EnglishDesc'),  operate: false},
                        {field: 'cover', title: __('Cover'), events: Table.api.events.image, formatter: Table.api.formatter.image, operate: false},
                        {field: 'english_cover', title: __('EnglishCover'), events: Table.api.events.image, formatter: Table.api.formatter.image, operate: false},
                        {field: 'address', title: __('Address')},
                        {field: 'english_address', title: __('EnglishAddress')},
                        {field: 'business_time', title: __('BusinessTime')},
                        {field: 'english_business_time', title: __('EnglishBusinessTime')},
                        {field: 'coupon_password', title: __('CouponPassword'), operate: false},
                        {field: 'longitude', title: __('Longitude')},
                        {field: 'latitude', title: __('Latitude')},
                        {field: 'is_show', title: __('IsShow'), formatter: Table.api.formatter.toggle, operate: false},
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