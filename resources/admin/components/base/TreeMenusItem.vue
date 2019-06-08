<template>
		<li ref="menuLi" :class="localValue.open?' menu-open':''" v-loaded-callback="active">
			<template v-if="localValue.children.length > 0">
				<a href="javascript:void(0)" v-on:click="localValue.open = !localValue.open">
		            <i :class="localValue.icon"></i> <span>{{ localValue.name }}</span>
		            <span class="pull-right-container">
		              <i class="fa fa-angle-left pull-right"></i>
		            </span>
		        </a>
				<ul class="treeview-menu" :style="localValue.open?'display:block':'display:none'">
					<template v-for="(m,k) in localValue.children">
						<tree-menus-item  v-model="localValue.children[k]"></tree-menus-item>
					</template>
				</ul>
			</template>
			<template v-else>
				<router-link :to="localValue.route">
					<i :class="localValue.icon"></i> <span>{{ localValue.name }}</span>
				</router-link>
			</template>
		</li>
</template>
<script>
export default {
	name: 'tree-menus-item',
	props: ['value'],
	data () { 
		return { 
			localValue: {}
		}
	},
	watch: {
		$route: 'active',
		localValue: {	
			handler: 'updateValue',
			deep: true
		},
    	value: 'setDefault'
	},
	created () {
		this.setDefault()
		this.active()
	},
	methods: {
		// 设置初始值
	  	setDefault () {
	  		this.localValue = this.value?this.value:{}
	  	},
	  	// 修改父件的值
	  	updateValue () {
	  		this.$emit('input',this.localValue)
	  	},
		// 递归设置contentheader信息
		setContentHeader (data) {
			if (typeof this.$parent.setContentHeader =='function'){
				if (this.localValue.pre_id) {
					data.splice(0,0,{title: this.localValue.name});
					this.$parent.setContentHeader(data);
				}else{
					data.splice(0,0,{title: this.localValue.name,icon:this.localValue.icon});
					this.$parent.setContentHeader(data);
				}
			}
		},
		active () {
			if (this.$route.meta.menu == this.localValue.route) {
				this.setContentHeader([]);
				$(this.$refs.menuLi).addClass('active')
			}else{
				$(this.$refs.menuLi).removeClass('active')
			}
		}
	}
}
</script>