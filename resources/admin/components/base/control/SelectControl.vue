<template>
	<div>
		<i class="fa fa-spinner fa-pulse" v-if='options.loading'/>
		<select v-model='localValue'  :disabled="options.disabled" v-else>
			<option value=''>请选择{{ options.title }}</option>
			<option v-for="o in options.options" :value='o.value'>{{ o.text }}</option>
		</select>
	</div>
</template>
<script>
export default{
	name: 'form-control-select',
	props: ['options', 'value'],
	data () {
		return {
			localValue: ''
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
	  		this.localValue = this.value
	  	},
	  	// 修改父件的值
	  	updateValue () {
	  		this.$emit('input',this.localValue)
	  	}
	}
}
</script>
<style scoped>
.form-control select{
	width: 100%;
	height:100%;
	border:0px;
}
.form-control{
	padding: 0;
}
.form-control .fa{
	margin: 9px;
}
</style>