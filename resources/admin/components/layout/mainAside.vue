<template>
    <aside class="main-sidebar">
	    <!-- sidebar: style can be found in sidebar.less -->
	    <section class="sidebar" style="height: auto;">
	      <!-- Sidebar user panel -->
	      <div class="user-panel">
	        <div class="pull-left image">
	          <img src="../../adminlte/dist/img/default_avatar.png" class="img-circle" alt="User Image">
	        </div>
	        <div class="pull-left info">
	          <p>{{ $store.state.user.name }}</p>
	          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
	        </div>
	      </div>
          <div v-if="loading"><i class="fa fa-spinner fa-pulse"></i></div>
          <v-tree-menus v-model="menus" v-else></v-tree-menus>
	    </section>
	    <!-- /.sidebar -->
	  </aside>
</template>

<script>
    import TreeMenus from '../../components/base/TreeMenus.vue'
    export default {
    	name: 'main-aside',
    	data () {
    		return {
    			menus: [],
    			contentHeader: {
    				title: '',
    				breadcrumb: [],
                    loading: false
    			},
                loading: false
    		}
    	},
    	created () {
    		this.getMenus();
    	},
    	methods: {
    		getMenus () {
    			var _this = this;
                var search = _this.$route.query;
                _this.loading = true
                axios.get('/api/v1/menus/umenus')
                .then(response => {
                    _this.toMenusTree(response.data)
                    _this.loading = false
                })
                .catch (response => {
                    if(response.response){
                        _this.alert({
                            title: '提示',
                            msg: _this.HttpStatusMsg(response.response.status)
                        });
                    }
                    _this.loading = false
                });
    		},
            // 处理menus
            toMenusTree (data) { 
                var narr = {};
                for (var i in data) { 
                    narr[data[i].id] = this.menuNode(data[i])
                }
                for (var j in narr) {
                    if(typeof narr[narr[j].pre_id] != 'undefined'){
                        narr[narr[j].pre_id].children.push(narr[j])
                    }
                }
                for (var k in narr) {
                    if(!narr[k].pre_id){
                        this.menus.push(narr[k])
                    }
                }
            },
            menuNode (d) { 
                return {
                    id: d.id,
                    pre_id: d.pre_id,
                    name: d.name,
                    icon: d.icon,
                    route: d.route,
                    active: false,
                    open: false,
                    children: []
                }
            },
    		// 由菜单获取content header信息
    		setContentHeader (data) {
    			if (data && data.length) {
    				this.contentHeader.title = data[data.length-1].title
    				this.contentHeader.breadcrumb = data
    			}
    		}
    	},
		components: {
			'v-tree-menus': TreeMenus
		}
    }
</script>
