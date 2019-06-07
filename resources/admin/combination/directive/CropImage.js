window.Vue = require('vue');
Vue.directive('crop-image', { 
  inserted: function (el,binding) {
	  // 基础参数
	  var options = {
			aspectRatio: 1,
	        zoomable: false,
	        crop: function (e) {
	        }
	  }
	  if (binding.value) {
		  for (var i in binding.value) {
			  options[i] = binding.value[i]
		  }
	  }
	  // 实例化
	  $(el).cropper(options)
  },
  update (el,binding) {
	// 基础参数
	  var options = {
			aspectRatio: 1,
	        zoomable: false,
	        crop: function (e) {
	        }
	  }
	  if (binding.value) {
		  for (var i in binding.value) {
			  options[i] = binding.value[i]
		  }
	  }
	  // 实例化
	  $(el).cropper('destroy').cropper(options)
  }
})