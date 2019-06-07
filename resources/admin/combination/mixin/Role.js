window.Vue = require('vue');
Vue.mixin({
  methods: {
	  hasRole (name) {
		  switch (name) {
		  	case 'admin': return this.hasRoleId(1);
		  	case 'beijing': return this.hasRoleId(2);
		  	case 'iascaas': return this.hasRoleId(3);
		  }
	  },
	  hasRoleId(id) {
		  var roles = this.$store.state.user.roles;
		  for (var i in roles){
			  if (roles[i].role_id == id) {
				  return true
			  }
		  }
		  return false
	  }
  }
})