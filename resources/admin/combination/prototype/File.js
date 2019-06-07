window.Vue = require('vue');
Vue.prototype.checkFileMaxsize = function (file, maxsize) {
  var maxsize = maxsize * 1024 * 1024
  if (file && file.size && file.size < maxsize) {
    return true
  } else {
    Vue.prototype.alert({
      msg: '文件超过指定大小(' + maxsize + 'M)'
    })
    return false
  }
}
