layui.use(['form', 'http', 'popup'], function () {
  let form = layui.form;
  let http = layui.http;
  let popup = layui.popup;
  let layadmin = layui.sessionData('layadmin');

  let actions = {
    setup: function () {
      this.getUser()
    },
    getUser: function () {
      http.ajax({
        url: '/api/users/' + layadmin.current.params.id,
        type: 'get',
        success: function (response) {
          if (response.status === 'success') {
            let data = response.data

            form.val('org-user-edit', {
              name: data.name,
              email: data.email,
            })
          } else {
            popup.failure(response.message);
          }
        },
        error: function (e, code) {
          http.ajax.logError(e)
        }
      })
    },
    updateUser: function (data) {
      http.ajax({
        url: '/api/users/' + layadmin.current.params.id,
        data: JSON.stringify(data.field),
        type: 'put',
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

  actions.setup();

  // 事件监听
  form.on('submit(org-user-edit-submit)', function (data) {
    actions.updateUser(data)
  });
})