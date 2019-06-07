<template>
	<div v-if="options">
		<i class="fa fa-spinner fa-pulse" v-if='options.loading'/>
		<div v-for="o in options.options" v-if="!options.loading">
			<input type="checkbox" v-model='localValue'  :value="o.value" :disabled="options.disabled"/> 
			<span>{{ o.text }}</span><br/>
		</div>
	</div>
</template>
<script>
export default{
	name: 'form-control-checkbox',
	props: ['options', 'value'],
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
	  	}
	}
}
</script>
<style scoped>
.form-control{
	height: auto;
	background-color: #f5f5f5;
	border: 1px solid #ccc;
    border-radius: 4px;
    padding: 9.5px !important;
}
.form-control pre{
	max-height:100px;
	overflow:y
}
.form-control input{
	vertical-align:middle;
	margin:0px;
}
.form-control span{
	vertical-align:middle;
}
.form-control{
	padding: 0;
}
.form-control .fa{
	margin: 9px;
}
</style>