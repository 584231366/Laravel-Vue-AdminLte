<template>
		<li ref="menuLi" v-on="active()">
			<template v-if="menu.children>0">
				<a href="javascript:void(0)">
		            <i :class="menu.icon"></i> <span>{{ menu.name }}</span>
		            <span class="pull-right-container">
		              <i class="fa fa-angle-left pull-right"></i>
		            </span>
		        </a>
				<ul class="treeview-menu">
					<template v-for="m in filterMenus">
						<tree-menus-item  :menus="menus" :menu="m"></tree-menus-item>
					</template>
				</ul>
			</template>
			<template v-else>
				<router-link :to="menu.route">
					<i :class="menu.icon"></i> <span>{{ menu.name }}</span>
				</router-link>
			</template>
		</li>
</template>
<script>
export default {
	name: 'tree-menus-item',
	props: ['menus', 'menu'],
	watch: {
		$route(to,from){
			this.active();
		}
	},
	methods: {
		// 递归设置contentheader信息
		setContentHeader (data) {
			if (typeof this.$parent.setContentHeader =='function'){
				if (this.menu.pre_id) {
					data.splice(0,0,{title: this.menu.name});
					this.$parent.setContentHeader(data);
				}else{
					data.splice(0,0,{title: this.menu.name,icon:this.menu.icon});
					this.$parent.setContentHeader(data);
				}
			}
		},
		active () {
			if (this.$route.meta.menu == this.menu.route) {
				this.setContentHeader([]);
				$(this.$refs.menuLi).addClass('active')
			}else{
				$(this.$refs.menuLi).removeClass('active')
			}
		}
	},
	computed: {
		filterMenus () {
			var _this = this
			return _this.menus.filter(function(m){
				return m.pre_id == _this.menu.id && _this.menu.id;
			});
		}
	}
}
</script>