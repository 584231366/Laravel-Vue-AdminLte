window.Vue = require('vue');
Vue.directive('datepicker', {
  // 当绑定元素插入到 DOM 中。
  inserted: function (el, binding, vnode) {
	var options = {
			format: 'yyyy-mm-dd',
			autoclose: true
	}
	if (binding.value) {
		  for (var i in binding.value) {
			  options[i] = binding.value[i]
		  }
	 }
    $(el).datepicker(options)
    if (vnode.data.on) {
      el.onchange = function (e) {
        if (typeof (vnode.data.on.input) === 'function') {
          vnode.data.on.input(e)
        }
        if (typeof (vnode.data.on.change) === 'function') {
          vnode.data.on.change(e)
        }
      }
    }
  }
})
