window.Vue = require('vue');
window.VueRouter = require('vue-router');
Vue.use(VueRouter);
window.router =new VueRouter({
	mode: 'history',
	routes: [
		        {
				  path: '/',
				  component: {template: "<router-view/>"},
				  children: [
					{
						  path: '/',
						  name: 'base',
						  redirect: '/admin/login',
						  component: {template: "<router-view/>"},
						  children: [
						     {
								 path: '/admin/login',
								 name: 'login',
								 meta: {
									 public: true,
									 title: '登录页'
								 },
								 components: require('../views/common/login.vue')
							}
						]
					},
					{
						path: '/',
						components:  require('../components/layout/layout.vue'),
						children: [
							{
							  path: '/admin/users',
							  redirect: '/admin/users/list',
							  component: {template: "<router-view/>"},
							  children: [
								{
									  path: '/admin/users/list',
									  name: 'userslist',
									  meta: {
										 public: false,
										 title: '用户管理',
										 menu: '/admin/users'
									  },
									  components: require('../views/base/userslist.vue')
								},
								{
									  path: '/admin/users/form',
									  name: 'usersform',
									  meta: {
										 public: false,
										 title: '用户管理',
										 menu: '/admin/users'
									  },
									  components: require('../views/base/usersform.vue')
								}
							  ]
							},
							{
							  path: '/admin/menus',
							  redirect: '/admin/menus/list',
							  component: {template: "<router-view/>"},
							  children: [
								{
									  path: '/admin/menus/list',
									  name: 'menuslist',
									  meta: {
										 public: false,
										 title: '菜单管理',
										 menu: '/admin/menus'
									  },
									  components: require('../views/base/menuslist.vue')
								},
								{
									  path: '/admin/menus/form',
									  name: 'menusform',
									  meta: {
										 public: false,
										 title: '菜单管理',
										 menu: '/admin/menus'
									  },
									  components: require('../views/base/menusform.vue')
								}
							  ]
							},
							{
							  path: '/admin/roles',
							  redirect: '/admin/roles/list',
							  component: {template: "<router-view/>"},
							  children: [
								{
									  path: '/admin/roles/list',
									  name: 'roleslist',
									  meta: {
										 public: false,
										 title: '角色管理',
										 menu: '/admin/roles'
									  },
									  components: require('../views/base/roleslist.vue')
								},
								{
									  path: '/admin/roles/form',
									  name: 'rolesform',
									  meta: {
										 public: false,
										 title: '角色管理',
										 menu: '/admin/roles'
									  },
									  components: require('../views/base/rolesform.vue')
								}
							  ]
							},
							{
							  path: '/admin/permissionsgroup',
							  redirect: '/admin/permissionsgroup/list',
							  component: {template: "<router-view/>"},
							  children: [
								{
									  path: '/admin/permissionsgroup/list',
									  name: 'permissionsgrouplist',
									  meta: {
										 public: false,
										 title: '权限组管理',
										 menu: '/admin/permissionsgroup'
									  },
									  components: require('../views/base/permissionsgrouplist.vue')
								},
								{
									  path: '/admin/permissionsgroup/form',
									  name: 'permissionsgroupform',
									  meta: {
										 public: false,
										 title: '权限组管理',
										 menu: '/admin/permissionsgroup'
									  },
									  components: require('../views/base/permissionsgroupform.vue')
								}
							  ]
							},
							{
								path: "admin/*",
								components: require('../views/errors/404.vue'),
								meta: {
									title: '404错误',
									public: false
								}
							}
						]
					}
				  ]
				}
	         ]
});
window.router.beforeEach((to, from, next) => {
	if (!store.state.user && !to.meta.public) {
	  router.push({
	      path: '/admin/login',
	      query: {redirect: to.path, query: to.query}
	  })
	  return;
  	}
  	$('title').text(to.meta.title);
  	next()
});
