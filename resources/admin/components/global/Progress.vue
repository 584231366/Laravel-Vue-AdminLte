<template>
	<div class="modal fade" ref="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-12" style="height:20px;">
	            			<div class="progress progress-striped" style="margin-bottom:0px">
	            				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60"  aria-valuemin="0" aria-valuemax="100" :style="'width:' + progress + '%'">
                    				<span class="sr-only">{{ progress}}%</span>
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-12 text-center" v-if="text"><strong>{{ text }}</strong></div>
	            		<div class="col-md-12 text-center" v-if="memo"><strong>{{ memo }}</strong></div>
	            	</div>
                </div>
	            </div>
	        </div><!-- /.modal-content -->
	    </div><!-- /.modal -->
	</div>
</template>
<script>
export default {
	name: 'progress-modal',
	data () {
		return {
			progress: 0,
			text: '',
			memo: ''
		}
	},
	methods: {
		show (data) {
			this.updateProgress(data)
			$(this.$refs.modal).modal({backdrop: 'static', keyboard: false});
		},
		hide () {
			$(this.$refs.modal).modal('hide');
			$('body').css({'padding-right': '0px'});
			this.clearProgress();
		},
		clearProgress () {
			this.progress = 0
			this.text = ''
			this.memo = ''
		},
		updateProgress (data){
			this.progress = data.progress
			this.text = data.text
			this.memo = data.memo
		}
	}
}
</script>