<template>
	<ul class="sidebar-menu tree" data-widget="tree">
		<template v-for="m in filterMenus">
			<v-item  :menus="menus" :menu="m" class="treeview"></v-item>
		</template>
	</ul>
</template>
<script>
import item from './TreeMenusItem.vue'
export default {
	name: 'tree-menus',
	props: ['menus'],
	methods: {
		// 由item内递归获取content header信息
		setContentHeader (data) {
			if (typeof this.$parent.setContentHeader =='function'){
				this.$parent.setContentHeader(data);
			}
		}
	},
	computed: {
		filterMenus () {
			return this.menus.filter(function(m){
				return !m.pre_id;
			});
		}
	},
	components: {
    	'v-item': item
    }
}
</script>