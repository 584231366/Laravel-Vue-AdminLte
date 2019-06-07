window.Vue = require('vue');
Vue.directive('select2', {
  // 当绑定元素插入到 DOM 中。
  inserted: function (el, binding, vnode) {
	var options = binding.value
	$(el).val(binding.value)
    $(el).select2()
    $(el).change(function () {
      var data = $(this).val()
      binding.value.splice(0, vnode.context.search.selectedColumns.length)
      for (var i in data) {
    	  binding.value.push(data[i])
      }
    })
  }
})
