<template>
	<div :class="large?'modal fade bs-example-modal-lg':'modal fade'" ref="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div :class="large?'modal-dialog modal-lg':'modal-dialog'">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title">
	                	<slot  name="title">拟态框标题</slot>
	                </h4>
	            </div>
	            <div class="modal-body"><slot  name="body"></slot></div>
	            <div class="modal-footer">
	            	<slot  name="footer">
	            		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">关闭</button>
	            		<button type="button" class="btn btn-default">确定</button>
	            	</slot>
	            </div>
	        </div><!-- /.modal-content -->
	    </div><!-- /.modal -->
	</div>
</template>
<script>
export default {
	name: 'modal',
	props: ['large'],
	methods: {
		show () {
			$(this.$refs.modal).modal('show');
		},
		hide () {
			$(this.$refs.modal).modal('hide');
		},
		static () {
			$(this.$refs.modal).modal({backdrop: 'static', keyboard: false});
		}
	}
}
</script>