define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'problem/keywords/index',
                    add_url: 'problem/keywords/add',
                    edit_url: 'problem/keywords/edit',
                    del_url: 'problem/keywords/del',
                    multi_url: 'problem/keywords/multi',
                    table: 'ginco_api_problem_search_keywords',
                }
            });

            var table = $("#table");

            var langList = {1:"中文", 2:"英文"};

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'ginco_api_problem_search_keywords.id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'keywords', title: __('Keywords')},
                        {field: 'sort', title: __('Sort'), sortable: true},
                        {field: 'lang', title: __('Lang'), searchList: langList, formatter: function (value, row) {
                            return langList[value];
                        }},
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