layui.use(['table', 'http', 'popup', 'common', 'form'], function () {
  let table = layui.table;
  let form = layui.form;
  let http = layui.http;
  let popup = layui.popup;
  let common = layui.common;
  let layadmin = layui.sessionData('layadmin');
  let tableUniqueId = layadmin.current.id;

  // 搜索
  form.on('submit(page-index-search-submit)', function (data) {
    let search = ''
    layui.each(data.field, function (key, item) {
      if (item) {
        search += (key + ":" + item + ";");
      }
    })

    const condition = search ? {search:search} : data.field;

    table.reload(tableUniqueId, {
      where: condition
    })
    return false;
  });

  // 表格头事件
  table.on(`toolbar(${tableUniqueId})`, function (obj) {
    if (obj.event === 'refresh') {
      actions.refresh();
    } else if (obj.event === 'sync') {
      actions.sync();
    }
  });

  // 表格行事件
  table.on(`tool(${tableUniqueId})`, function (obj) {
   if (obj.event === 'view') {
      actions.view(obj.data);
    }
  });

  let actions = {
    setup: function () {
    },
    view: function (data) {
      layer.open({
        type: 2,
        title: '详情',
        content: '/' + layadmin.config.routes.web.prefix + '/system/page/editor?id=' + data.id,
        area: [common.isModile() ? '100%' : '800px', common.isModile() ? '100%' : '600px'],
        shade: 0.1,
        closeBtn: 1,
        scrollbar: false,
        maxmin: true,
      });
    },
    sync: function () {
      layer.confirm('确定要同步？', {
        icon: 3,
        title: '提示'
      }, function (index) {
        layer.close(index);
        let loading = layer.load();
        http.ajax({
          url: '/api/pages/sync',
          type: "put",
          success: function (response) {
            layer.close(loading);
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
      });
    },
    refresh: function () {
      table.reload(tableUniqueId);
    }
  }
})
