layui.use(['admin', 'popup', 'http', 'util', 'layer', 'common'], function () {
  if (window !== top) {
    top.location.href = location.href;
  }

  var admin = layui.admin;
  var popup = layui.popup;
  var http = layui.http;
  var util = layui.util;
  var layer = layui.layer;

  let layadmin = layui.sessionData('layadmin');

  admin.render(layadmin[layadmin.current.id].components);

  let actions = {
    logout: function () {
      http.ajax({
        url: '/api/logout',
        type: 'DELETE',

        success: function (response) {
          if (response.status === 'success') {
            popup.success(response.message, function () {
              location.href = '/' + layadmin.config.route.prefix + "/login";
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
    clear: function () {
      layer.confirm('确定要清除缓存？', {
        icon: 3,
        title: '提示'
      }, function (index) {
        layer.close(index);
        let loading = layer.load();
        http.ajax({
          url: '/api/clear',
          type: 'DELETE',
          success: function (response) {
            layer.close(loading);
            if (response.status === 'success') {
              popup.success(response.message,function () {
                localStorage.clear()
                sessionStorage.clear()
                location.href = layadmin.config.path.home;
              })
            } else {
              popup.failure(response.message);
            }
          },
          error: function (e, code) {
            http.ajax.logError(e)
          }
        })
      });
    }
  }


  // 登出逻辑
  admin.logout(function () {
    actions.logout();

    // 注销逻辑 返回 true / false
    return true;
  })

  // 初始化消息回调
  admin.message();

  // 实现消息回调 [消息列表点击事件]
  // admin.message(function(id, title, context, form) {});

  util.event('lay-active', {
    clear: function () {
      actions.clear()
    }
  });
})