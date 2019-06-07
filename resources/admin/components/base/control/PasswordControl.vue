<template>
	<input v-model='localValue' type="password" :disabled="options.disabled"/>
</template>
<script>
export default{
	name: 'form-control-password',
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