layui.use(['form', 'popup', 'http'], function () {
  var popup = layui.popup;
  var http = layui.http;
  var form = layui.form;
  let layadmin = layui.sessionData('layadmin');

  let actions = {
    setup: function () {
      this.fetchConfig();
    },
    fetchConfig: function () {
      http.ajax({
        url: '/api/configs/all',
        type: 'get',
        success: function (response) {
          if (response.status === 'success') {
            let data = response.data

            // 基础配置
            form.val('config-app', {
              name: data.app.name,
              env: data.app.env,
              timezone: data.app.timezone,
              debug: data.app.debug,
            })

            // 后台配置
            form.val('config-admin', {
              "path[prefix]": data.layadmin.path.prefix,
              "path[home]": data.layadmin.path.home,
              title: data.layadmin.title,
              desc: data.layadmin.desc,
            })

            // 扩展配置
            layui.each(data.cache.stores, function (key, item) {
              layui.$('#CACHE_DRIVER').append(new Option(key, item.driver))
              form.render('select')
            });

            layui.each(data.logging.channels, function (key, item) {
              layui.$('#LOG_CHANNEL').append(new Option(key, item.driver))
              form.render('select')
            });

            layui.each(data.queue.connections, function (key, item) {
              layui.$('#QUEUE_CONNECTION').append(new Option(key, item.driver))
              form.render('select')
            });

            layui.each(data.mail.mailers, function (key, item) {
              layui.$('#MAIL_MAILER').append(new Option(key, item.transport))
              form.render('select')
            });

            layui.each(data.filesystems.disks, function (key, item) {
              layui.$('#FILESYSTEM_DRIVER').append(new Option(key, item.transport))
              form.render('select')
            });

            layui.each(data.broadcasting.connections, function (key, item) {
              layui.$('#BROADCAST_DRIVER').append(new Option(key, item.driver))
              form.render('select')
            });

            form.val('config-extend', {
              "cache[driver]": data.cache.default,
              "cache[prefix]": data.cache.prefix,
              "log[channel]": data.logging.default,
              "log[query]": data.logging.query.enabled,
              "log[request]": data.logging.request.enabled,
              "mail[mailer]": data.mail.default,
              "mail[address]": data.mail.from.address,
              "mail[name]": data.mail.from.name,
              "queue[connection]": data.queue.default,
              "broadcast[driver]": data.broadcasting.default,
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
    updateConfig: function (item, data) {
      http.ajax({
        url: '/api/configs/' + item,
        data: JSON.stringify(data),
        type: 'put',
        success: function (response) {
          if (response.status === 'success') {
            popup.success(response.message, function () {
              if (item === 'layadmin') {
                location.href = '/'+layadmin.config.routes.web.prefix + '/home'
              } else {
                top.layui.admin.refreshThis();
              }
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
  form.on('submit(config-app)', function (data) {
    let req = {
      env: data.field.env,
      locale: data.field.locale,
      name: data.field.name,
      timezone: data.field.timezone,
      debug: !!data.field.debug || false,
    }

    actions.updateConfig('app', req)
  });

  form.on('submit(config-admin)', function (data) {
    let req = {
      path: {
        prefix: data.field["path[prefix]"],
        home: data.field["path[home]"],
      },
      title: data.field.title,
      desc: data.field.desc
    }

    actions.updateConfig('layadmin', req)
  });

  form.on('submit(config-extend)', function (data) {
    let req = {
      logging: {
        default: data.field["log[channel]"],
        query: {
          enabled: !!data.field["log[query]"] || false
        },
        request: {
          enabled: !!data.field["log[request]"] || false
        },
      },
      mail: {
        default: data.field["mail[mailer]"],
        from: {
          address: data.field["mail[address]"],
          name: data.field["mail[name]"],
        }
      },
      broadcasting:{
        default:data.field["broadcast[driver]"],
      },
      cache:{
        default:data.field["cache[driver]"],
      },
      filesystems:{
        default:data.field["filesystems[driver]"],
      },
      queue:{
        default:data.field["queue[connection]"],
      }
    }

    actions.updateConfig('extend', req)
  });
});