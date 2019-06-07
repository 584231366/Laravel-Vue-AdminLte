<template>
	<div class="input-group" v-on:click="openFileInput">
		<input type="text"  :value="showInfo" placeholder="选择文件" readonly>
	    <input ref='file' type='file' v-on:change="onChangeFile"  :disabled="options.disabled" class="form-control" style="display:none">
	    <span class="input-group-addon"><i class="fa fa-folder-open-o"></i></span>
	</div>
</template>
<script>
export default{
	name: 'form-control-input',
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
	computed: {
		showInfo () {
			var info = this.localValue
			if (typeof info == 'object') {
				info = this.localValue.name
			}
			return info
		}
	},
	methods: {
		// 设置初始值
	  	setDefault () {
	  		this.localValue = this.value
	  	},
	  	// 修改父件的值
	  	updateValue () {
	  		this.$emit('input', this.localValue)
	  	},
	  	// 文件切换
	  	onChangeFile (e) {
	  	  	this.localValue = e.target.files[0]
	  	},
	  	// 打开文件选择
	  	openFileInput () {
	  		this.$refs.file.click()
	  	}
	}
}
</script>
<style scoped>
	.form-control{
		padding: 0;
	}
	.form-control input{
		width:100%;
		height:100%;
		border:0;
		padding: 6px 12px;
	}
	.form-control .input-group-addon{
		border:0;
	}
</style>