define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'banner/banner/index',
                    add_url: 'banner/banner/add',
                    edit_url: 'banner/banner/edit',
                    del_url: 'banner/banner/del',
                    multi_url: 'banner/banner/multi',
                    table: 'ginco_api_banner',
                }
            });

            var table = $("#table");
            var moduleList = {
                'home_page': '首页',
                'hotel_list': '酒店列表',
                'hotel_info': '酒店详情',
                'service': '服务',
                'article_list': '文章列表',
                'article_info': '文章详情',
                'music_album': '音乐专辑',
            };

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'ginco_api_banner.id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id'), sortable: true},
                        {field: 'module', title: __('Module'), searchList: moduleList, formatter: function (value, row) {
                            return moduleList[value];
                        }},
                        {field: 'cover', title: __('Cover'), events: Table.api.events.image, formatter: Table.api.formatter.image, operate: false},
                        {field: 'english_cover', title: __('EnglishCover'), events: Table.api.events.image, formatter: Table.api.formatter.image, operate: false},
                        {field: 'sort', title: __('Sort'), sortable: true},
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