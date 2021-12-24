layui.use(['table', 'http', 'popup', 'common', 'treetable'], function () {
  let common = layui.common;
  let table = layui.table;
  let http = layui.http;
  let popup = layui.popup;
  let layadmin = layui.sessionData('layadmin');
  let tableUniqueId = layadmin.current.id;
  let treetable = layui.treetable;

  layui.sessionData(tableUniqueId, {
    key: 'close',
    value: layadmin[layadmin.current.id].components.table.config.treeDefaultClose
  })

  // 表格头事件
  table.on(`toolbar(${tableUniqueId})`, function (obj) {
    if (obj.event === 'refresh') {
      actions.refresh();
    } else if (obj.event === 'add') {
      actions.add();
    } else if (obj.event === 'toggle') {
      let page = layui.sessionData(tableUniqueId)
      if (!page.close) {
        layui.sessionData(tableUniqueId, {key: 'close', value: true})
        treetable.foldAll(`#${tableUniqueId}`);
      } else {
        layui.sessionData(tableUniqueId, {key: 'close', value: false})
        treetable.expandAll(`#${tableUniqueId}`);
      }
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

  // 监听单元格编辑
  table.on(`edit(${tableUniqueId})`, function (obj) {
    actions.update(obj.data.id, obj.field, obj.value)
  });

  let actions = {
    add: function () {
      layer.open({
        type: 2,
        title: '新增',
        content: '/' + layadmin.config.path.prefix + '/system/menu/add',
        area: [common.isModile() ? '100%' : '600px', common.isModile() ? '100%' : '520px'],
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
        content: '/' + layadmin.config.path.prefix + '/system/menu/edit?id=' + data.id,
        area: [common.isModile() ? '100%' : '600px', common.isModile() ? '100%' : '520px'],
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
          url: '/api/menus/' + data.id,
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
    update: function (id, field, value) {
      let data = {}
      data[field] = value

      http.ajax({
        url: '/api/menus/' + id + '/order',
        type: "patch",
        data: JSON.stringify(data),
        success: function (response) {
          if (response.status === 'success') {
            popup.success(response.message, function () {
              table.reload(tableUniqueId);
            });
          } else {
            popup.failure(response.message);
          }
        },
        error: function (e, code) {
          http.ajax.logError(e)
        }
      })
    },
    refresh: function () {
      top.layui.admin.refreshThis()
    }
  }
})
