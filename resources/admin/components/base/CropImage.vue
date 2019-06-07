<template>
  <div style="width:100%;height:100%;" class="text-center">
    <img :src='cropImage' v-on:load="loaded($event)" :style="imgStyle"/>
  </div>
</template>
<script>
import defaultImg from '@/assets/img/default_img.jpg'
export default{
  name: 'crop-image',
  data () {
    return {
      cropImage: '',
      cropImageEl: null,
      jcropObj: null,
      cropDetail: null,
      file: null
    }
  },
  computed: {
    cropOptions () {
      var _this = this
      return {
        aspectRatio: 1,
        zoomable: false,
        crop: function (e) {
          _this.cropDetail = e.detail
        }
      }
    },
    imgStyle () {
      return {
        width: '500px',
        height: '500px',
        margin: '0 auto'
      }
    }
  },
  created () {
    this.cropImage = defaultImg
    this.cropData = new FormData()
  },
  methods: {
    loaded (e) {
      this.cropImageEl = e.target
      this.initCrop()
    },
    initCrop () {
      $(this.cropImageEl).cropper(this.cropOptions)
    },
    // 选择图片
    changeImage () {
      var _this = this
      var input = document.createElement('input')
      input.setAttribute('type', 'file')
      input.onchange = function (e) {
        _this.file = e.target.files[0]
        var read = new FileReader()
        read.readAsDataURL(e.target.files[0])
        read.onload = function () {
          $(_this.cropImageEl).cropper('destroy').attr('src', read.result).cropper(_this.cropOptions)
        }
      }
      input.click()
    },
    getCropResult () {
      var data = new FormData()
      data.append('file', this.file)
      data.append('x', this.cropDetail.x)
      data.append('y', this.cropDetail.y)
      data.append('width', this.cropDetail.width)
      data.append('height', this.cropDetail.height)
      return data
    }
  }
}
</script>