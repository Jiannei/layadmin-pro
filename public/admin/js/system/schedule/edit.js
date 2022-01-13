layui.use(['form', 'http', 'popup', 'select'], function () {
  let form = layui.form;
  let http = layui.http;
  let popup = layui.popup;
  let layadmin = layui.sessionData('layadmin');
  let select = layui.select;

  select.data('environments', 'server', {
    url: '/api/options/environments',
    keyword: 'environments'
  })

  let actions = {
    setup: function () {
      this.getSchedule()
    },
    getSchedule: function () {
      http.ajax({
        url: '/api/schedules/' + layadmin.current.params.id,
        type: 'get',
        success: function (response) {
          if (response.status === 'success') {
            let data = response.data

            form.val('system-schedule-edit', data)
            select.value('environments', data.environments)
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
        url: '/api/schedules/' + layadmin.current.params.id,
        data: JSON.stringify(data.field),
        type: 'put',
        success: function (response) {
          if (response.status === 'success') {
            popup.success(response.message, function () {
              parent.layer.close(parent.layer.getFrameIndex(window.name));//关闭当前页
              parent.layui.table.reload("system-schedule-index");
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
  form.on('submit(system-schedule-edit-submit)', function (data) {
    actions.updateUser(data)
  });
})