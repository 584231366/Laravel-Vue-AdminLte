<template>
	<v-modal ref="modal">
   		<template slot="title">{{ title }}</template>
   		<template slot="body">
   			<div class="text-center">{{ msg }}</div>
   		</template>
   		<template slot="footer">
   			 <button type="button" class="btn btn-default  pull-left" data-dismiss="modal" v-on:click="onCancel()">关闭</button>
             <button type="button" class="btn btn-default" v-on:click="onConfirm()" data-dismiss="modal">确认</button>
   		</template>
   </v-modal>
</template>
<script>
import modal from '../../components/base/Modal.vue'
export default {
	name: 'modal-alert',
	data () {
		return {
			title: '提示',
			msg: '请输入提示内容',
			onConfirmCallback: null,
			onCancelCallback: null,
		}
	},
	methods: {
		show (options) {
			this.reset();
			if (options.title) {
				this.title = options.title;
			}
			if (options.msg) {
				this.msg = options.msg;
			}
			this.onConfirmCallback = options.onConfirm;
			this.onCancelCallback = options.onCancel;
			this.$refs.modal.static();
		},
		reset () {
			this.title = '提示';
			this.msg = '请输入提示内容';
			this.onConfirmCallback = null;
			this.onCancelCallback = null;
		},
		onConfirm () {
			if (typeof this.onConfirmCallback == 'function') {
				this.onConfirmCallback();
			}
		},
		onCancel () {
			if (typeof this.onConfirmCallback == 'function') {
				this.onCancelCallback();
			}
		}
	},
  components: {
    'v-modal': modal
  }
}
</script>