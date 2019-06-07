window.Vue = require('vue');
Vue.mixin({
  methods: {
	  HttpStatusMsg (status) {
		  var msg = '';
		  switch(status){
		  	case 400: msg = '参数错误，请检查后再试！';break;
		  	case 401: msg = '登录凭证失效，请重新登录！';break;
		  	case 403: msg = '服务器拒绝访问，或者您没有访问和操作权限！';break;
		  	case 404: msg = '资源不存在！';break;
		  	case 500: msg = '系统内部错误！';break;
		  	default: msg = status+'错误！';
		  }
		  return msg
	  }
  }
})