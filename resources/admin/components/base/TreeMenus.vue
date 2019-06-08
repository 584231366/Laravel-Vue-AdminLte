<template>
	<ul class="sidebar-menu tree" data-widget="tree">
		<template v-for="(m,k) in localValue">
			<v-item v-model="localValue[k]" class="treeview"></v-item>
		</template>
	</ul>
</template>
<script>
import item from './TreeMenusItem.vue'
export default {
	name: 'tree-menus',
	props: ['value'],
	data () { 
		return { 
			localValue: []
		}
	},
	watch: {
		localValue: 'updateValue',
    	value: 'setDefault'
	},
	created () {
		this.setDefault()
	},
	methods: {
		// 设置初始值
	  	setDefault () {
	  		this.localValue = this.value?this.value:[]
	  	},
	  	// 修改父件的值
	  	updateValue () {
	  		this.$emit('input',this.localValue)
	  	},
	  	// 由item内递归获取content header信息
		setContentHeader (data) {
			if (typeof this.$parent.setContentHeader =='function'){
				this.$parent.setContentHeader(data);
			}
		}
	},
	components: {
    	'v-item': item
    }
}
</script>