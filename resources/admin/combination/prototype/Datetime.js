window.Vue = require('vue');
// 至今时间中文表示
Vue.prototype.FDateToNow = function (timeStr) {
  if (timeStr === null || timeStr === '') {
    return
  }
  timeStr = timeStr + ''
  var endStr = (timeStr).replace(/-/g, '/')
  var classTime = Date.parse(new Date(endStr))
  var nowTime = Date.parse(new Date())
  var totalSecs = (classTime - nowTime) / 1000
  var days = Math.ceil(totalSecs / 3600 / 24)
  var hours = Math.ceil((totalSecs - days * 24 * 3600) / 3600)
  var mins = Math.ceil((totalSecs - days * 24 * 3600 - hours * 3600) / 60)
  var secs = Math.ceil((totalSecs - days * 24 * 3600 - hours * 3600 - mins * 60))

  if (days !== 0) {
    return Math.abs(days) + '天前'
  } else if (hours === 0 && mins === 0) {
    return Math.abs(secs) + '秒前'
  } else if (hours === 0 && mins !== 0) {
    return Math.abs(mins) + '分钟前'
  } else if (hours !== 0) {
    return Math.abs(hours) + '小时前'
  } else {
    return timeStr.substr(0, 10)
  }
}
