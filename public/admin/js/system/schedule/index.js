layui.use(['table', 'http', 'popup', 'common', 'form'], function () {
  let common = layui.common;
  let table = layui.table;
  let http = layui.http;
  let popup = layui.popup;
  let form = layui.form;
  let layadmin = layui.sessionData('layadmin');
  let tableUniqueId = layadmin.current.id;

  // 搜索
  form.on('submit(schedule-index-search-submit)', function (data) {
    table.reload(tableUniqueId, {
      where: common.search(data)
    })

    return false;
  });

  // 表格头事件
  table.on(`toolbar(${tableUniqueId})`, function (obj) {
    if (obj.event === 'refresh') {
      actions.refresh();
    } else if (obj.event === 'add') {
      actions.add();
    }
  });

  // 表格行事件
  table.on(`tool(${tableUniqueId})`, function (obj) {
    if (obj.event === 'delete') {
      actions.delete(obj.data);
    } else if (obj.event === 'edit') {
      actions.edit(obj.data);
    }
  });

  let actions = {
    add: function () {
      layer.open({
        type: 2,
        title: '新增',
        content: '/' + layadmin.config.routes.web.prefix + '/system/schedule/add',
        area: [common.isModile() ? '100%' : '700px', common.isModile() ? '100%' : '500px'],
        shade: 0.1,
        closeBtn: 1,
        scrollbar: false,
        maxmin: true,
      });
    },
    edit: function (data) {
      layer.open({
        type: 2,
        title: '编辑',
        content: '/' + layadmin.config.routes.web.prefix + '/system/schedule/edit?id=' + data.id,
        area: [common.isModile() ? '100%' : '700px', common.isModile() ? '100%' : '500px'],
        shade: 0.1,
        closeBtn: 1,
        scrollbar: false,
        maxmin: true,
      });
    },
    delete: function (data) {
      layer.confirm('确定要删除？', {
        icon: 3,
        title: '提示'
      }, function (index) {
        layer.close(index);
        let loading = layer.load();
        http.ajax({
          url: '/api/schedules/' + data.id,
          dataType: 'json',
          type: 'delete',
          success: function (response) {
            layer.close(loading);
            if (response.status === 'success') {
              popup.success(response.message, function () {
                actions.refresh()
              });
            } else {
              popup.failure(response.message);
            }
          }
        })
      });
    },
    refresh: function () {
      table.reload(tableUniqueId);
    }
  }
})
