layui.use(['form', 'http', 'popup'], function () {
  let form = layui.form;
  let http = layui.http;
  let popup = layui.popup;

  let actions = {
    setup: function () {
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
    addRole: function (data) {
      http.ajax({
        url: '/api/roles',
        data: JSON.stringify(data.field),
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
  form.on('submit(org-role-add-submit)', function (data) {
    actions.addRole(data)
  });
})