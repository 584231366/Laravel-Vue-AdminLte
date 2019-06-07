window.Vue = require('vue');
Vue.mixin({
  methods: {
	  hasPermission (permission) {
		 var permissions = this.$store.state.user.permissions;
		 for (var i in permissions){
			 if (permissions[i] == permission) {
				 return true
			 }
		 }
		 return false
	  }
  }
})