<template>
  <div>
    <a href="javascript:void(0)" v-on:click="openFileInput()">
      <template v-if="!preview"><i class="fa fa-folder-open-o"></i> 选择文件</template>
      <img v-else :src="preview" alt="选择图片" ref="preview" style="max-height:100px"/>
    </a>
    <input type="file" ref='fileinput' v-on:change='onChangeFile' style='display:none'/>
  </div>
</template>
    
<script>
export default {
  name: 'components-base-control-ImageControl',
  props: ['options', 'value', 'disabled'],
  data () {
    return {
      localValue: null,
      preview: null
    }
  },
  watch: {
    localValue: 'updateValue'
  },
  created (){
    this.setPreview()
  },
  methods: {
    // 修改父件的值
    updateValue () {
      this.$emit('input', this.localValue)
    },
    // 文件切换
    onChangeFile (e) {
        this.localValue = e.target.files[0]
        this.setPreview()
    },
    // 打开文件选择
    openFileInput () {
      this.$refs.fileinput.click()
    },
    setPreview () {
      if(typeof this.localValue == 'object'){
        var _this = this
        var file = this.localValue
        var fr = new FileReader()
        fr.onload = function(file){
          _this.preview = file.target.result
        }
        fr.readAsDataURL(file);
      }else{
        this.preview = this.value
      }
    }
  }
}
</script>
<style scoped>
  .form-control{
    height:auto;
  }
</style>