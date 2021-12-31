layui.use(['form', 'http', 'popup'], function () {
  let form = layui.form;
  let http = layui.http;
  let popup = layui.popup;

  let actions = {
    setup: function () {

    },
    addAdminUser: function (data) {
      http.ajax({
        url: '/api/users',
        data: JSON.stringify(data.field),
        success: function (response) {
          if (response.status === 'success') {
            popup.success(response.message, function () {
              parent.layer.close(parent.layer.getFrameIndex(window.name));//关闭当前页
              parent.layui.table.reload("org-user-index");
            });
          } else {
            popup.failure(response.message);
          }
        },
        error: function (e, code) {
          http.ajax.logError(e)
        }
      })
    }
  }

  // 事件监听
  form.on('submit(org-user-add-submit)', function (data) {
    actions.addAdminUser(data)
  });
})