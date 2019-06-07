window.Vue = require('vue');
Vue.directive('focus', {
  inserted: function (el) {
	el.focus()
  }
})