define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'music/album/index',
                    add_url: 'music/album/add',
                    edit_url: 'music/album/edit',
                    del_url: 'music/album/del',
                    multi_url: 'music/album/multi',
                    table: 'ginco_api_music_album',
                }
            });

            var table = $("#table");
            var playUrlType = 'mp3';


            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'ginco_api_music_album.id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id'), sortable: true},
                        {field: 'title', title: __('Title')},
                        {field: 'english_title', title: __('EnglishTitle')},
                        {field: 'desc', title: __('Desc'), operate: false},
                        {field: 'english_desc', title: __('EnglishDesc'),  operate: false},
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