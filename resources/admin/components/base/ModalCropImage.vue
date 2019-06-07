<template>
   <v-modal ref="modal">
   		<template slot="title">{{ options.title }}</template>
   		<template slot="body">
   			<div class="row" style="width:100%">
   				<div class="col-md-12 text-center"  style="width:100%">
   					<img ref="img" src="" alt="选择图片" style="max-width:400px;max-height:400px;margin:0 auto;" v-default-image="{width:'400px',height:'400px'}"/>
   				</div>
   				<div class="col-md-12 text-center">
   					<br/>
   					<button class="btn btn-default" v-on:click="chooseFile()">选择图片</button>
   				</div>
   			</div>
   			<input type="file" style="display:none" ref="chooseFile" v-on:change="onChange()"/>
   		</template>
   		<template slot="footer">
   			 <button type="button" class="btn btn-default  pull-left" data-dismiss="modal">关闭</button>
              <button type="button" class="btn btn-default" v-if="submiting">
                <i class="fa fa-spinner fa-pulse"></i> 保存
              </button>
              <button type="button" class="btn btn-default"  v-else v-on:click='saveCallback()'>保存</button>
   		</template>
   </v-modal>
</template>
<script>
export default {
  name: 'components-modal-cropImage',
  props: ['options', 'submiting'],
  data () {
    return {
      form: {},
      errors: {},
      cropper: null,
      base64: null,
      detail: null
    }
  },
  computed: {},
  methods: {
  	getResult () {
  		return {
  			base64: this.base64,
  			detail: this.detail,
  			file: this.$refs.chooseFile.files[0]
  		}
  	},
    show () {
      this.$refs.modal.static()
    },
    hide () {
      this.$refs.modal.hide()
    },
    saveCallback () {
      if (typeof this.options.saveCallback === 'function') {
        this.options.saveCallback()
      }
    },
    chooseFile () {
    	this.$refs.chooseFile.click()
    },
    onChange () {
    	var _this = this
    	var file = _this.$refs.chooseFile.files[0]
    	var read = new FileReader()
        read.readAsDataURL(file)
        read.onload = function () {
        	if (_this.cropper) {
        		$(_this.$refs.img).cropper('destroy')
        	}
        	_this.cropper =$(_this.$refs.img).attr('src', read.result).cropper({
        		aspectRatio: 1,
        		zoomable: false,
        		crop (e) {
        			_this.base64 = read.result
        			_this.detail = e.detail
        		}
        	});
        }
    }
  },
  components: {
    'v-modal': require('../../components/base/Modal')
  }
}
</script>