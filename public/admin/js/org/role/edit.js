layui.use(['form', 'http', 'popup'], function () {
  let form = layui.form;
  let http = layui.http;
  let popup = layui.popup;
  let layadmin = layui.sessionData('layadmin');

  let actions = {
    setup: function () {
      this.getRole();
      this.getGuards();
    },
    getGuards: function () {
      http.ajax({
        url: '/api/options/guards',
        type: 'get',
        success: function (response) {
          if (response.status === 'success') {
            layui.each(response.data, function (key, item) {
              layui.$('#guard_name').append(new Option(item.name, item.value))
              form.render('select')
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
    getRole: function () {
      http.ajax({
        url: '/api/roles/' + layadmin.current.params.id,
        type: 'get',
        success: function (response) {
          if (response.status === 'success') {
            let data = response.data

            form.val('org-role-edit', {
              name: data.name,
              description: data.description,
              guard_name: data.guard_name,
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
    updateRole: function (data) {
      http.ajax({
        url: '/api/roles/' + layadmin.current.params.id,
        data: JSON.stringify(data.field),
        type: 'put',
        success: function (response) {
          if (response.status === 'success') {
            popup.success(response.message, function () {
              parent.layer.close(parent.layer.getFrameIndex(window.name));//关闭当前页
              parent.layui.table.reload("org-role-index");
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
  form.on('submit(org-role-edit-submit)', function (data) {
    actions.updateRole(data)
  });
})