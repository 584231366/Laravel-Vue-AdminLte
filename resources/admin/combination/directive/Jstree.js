window.Vue = require('vue');
Vue.directive('jstree', { 
  inserted: function (el,binding) {
	  var options = binding.value
	  var _this = this
	  $(el).jstree(options)
	  if (options.binds) {
		  if (typeof options.binds.select_node == 'function') {
			  $(el).bind('select_node.jstree', function (e, data) {
				  options.binds.select_node({data: data,e:e,el: el})
			  })
		  }
		  if (typeof options.binds.changed == 'function') {
			  $(el).bind('changed.jstree', function (e, data) {
				  options.binds.changed({data: data,e:e,el: el})
			  })
		  }
	  }
  },
  update (el,binding) {
	  // 防止无限循环更新
	  var a = typeof binding.value.changed === 'undefined';
	  var b = typeof binding.value.changed !== 'undefined' && binding.value.changed!==binding.oldValue.changed;
	  if (a || b) {
		  var options = binding.value
		  for(var i in options){
			  $(el).jstree(true).settings[i] = options[i]
		  }
		  $(el).jstree(true).refresh()
	  }
  }
})