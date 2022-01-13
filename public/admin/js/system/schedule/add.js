layui.use(['form', 'http', 'popup','select'], function () {
  let form = layui.form;
  let http = layui.http;
  let popup = layui.popup;

  let select = layui.select;

  select.data('environments', 'server', {
    url: '/api/options/environments',
    keyword: 'environments'
  })

  let actions = {
    setup: function () {

    },
    addSchedule: function (data) {
      http.ajax({
        url: '/api/schedules',
        data: JSON.stringify(data.field),
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

  // 事件监听
  form.on('submit(system-schedule-add-submit)', function (data) {
    actions.addSchedule(data)
  });
})