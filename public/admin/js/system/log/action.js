layui.use(['table', 'http', 'popup', 'common'], function () {
  let common = layui.common;
  let table = layui.table;
  let http = layui.http;
  let popup = layui.popup;
  let layadmin = layui.sessionData('layadmin');
  let tableUniqueId = layadmin.current.id;

  // 表格头事件
  table.on(`toolbar(${tableUniqueId})`, function (obj) {
    if (obj.event === 'refresh') {
      actions.refresh();
    } else if (obj.event === 'clean') {
      actions.clean();
    }
  });

  let actions = {
    clean: function () {
      layer.confirm('确定要清除？', {
        icon: 3,
        title: '提示'
      }, function (index) {
        layer.close(index);
        let loading = layer.load();
        http.ajax({
          url: '/api/logs/action',// todo 选择清除日志类型
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
