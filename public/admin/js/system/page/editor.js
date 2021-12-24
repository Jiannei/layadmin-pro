window.editor = new JSONEditor(document.getElementById("jsoneditor"), {
  mode: 'code',
  modes: ['code', 'preview'],
})

layui.use(['http', 'popup'], function () {
  let http = layui.http;
  let popup = layui.popup;
  let layadmin = layui.sessionData('layadmin');

  let actions = {
    setup: function () {
      this.fetchPage();
    },
    fetchPage: function () {
      http.ajax({
        url: '/api/pages/' + layadmin.current.params.id,
        type: 'get',
        success: function (response) {
          if (response.status === 'success') {
            editor.set(response.data)
          } else {
            popup.failure(response.message);
          }
        },
        error: function (e, code) {
          http.ajax.logError(e)
        }
      })
    },
  }

  actions.setup();
})

