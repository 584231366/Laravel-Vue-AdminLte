window.Vue = require('vue');
Vue.directive('loaded', {
  // 当绑定元素插入到 DOM 中。
  inserted: function (el, binding, vnode) {
    $('body').resize()
  }
})
Vue.directive('loaded-callback', {
  // 当绑定元素插入到 DOM 中。
  inserted: function (el, binding, vnode) {
    binding.value(el, binding, vnode)
  }
})
