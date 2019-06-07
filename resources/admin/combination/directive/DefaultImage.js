window.Vue = require('vue');
// 默认显示图片
Vue.directive('default-image', {
  inserted: function (el,binding) {
	el.onerror = function () {
		var width = parseInt(el.width);
		var height = parseInt(el.height);
		if (binding.value && (binding.value.width && binding.value.height)) {
			width = parseInt(binding.value.width);
			height = parseInt(binding.value.height);
		}
		var fontSize = (height>width?width:height)/10;
		fontSize=fontSize>30?30:fontSize;
		var title = width + " X " + height;
		if (binding.value && binding.value.title) {
			title = binding.value.title;
		}
	    var canvas = document.createElement('canvas');
		canvas.width = width;
		canvas.height = height;
		var cxt=canvas.getContext("2d");
		cxt.fillStyle="#d6d6d6";
		cxt.fillRect(0,0,width,height);
		cxt.textAlign = 'center'
		cxt.fillStyle="#fff";
		
		cxt.font = fontSize +"px Arial";
		cxt.fillText(title,width/2,height/2 + fontSize/2);
		this.src = canvas.toDataURL();
	}
  }
})