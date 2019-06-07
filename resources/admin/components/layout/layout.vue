<template>
  <div class="wrapper">
    <v-header></v-header>
    <v-main-aside ref="menus"></v-main-aside>
    <div class="content-wrapper">
      <v-content-header></v-content-header>
      <router-view></router-view>
    </div>
    <v-footer></v-footer>
    <v-alert ref="alert"></v-alert>
    <v-confirm ref="confirm"></v-confirm>
    <v-progress ref="progress"></v-progress>
  </div>
</template>

<script>
window.Vue = require('vue');
import header from './header.vue'
import footer from './footer.vue'
import mainaside from './mainAside.vue'
import contentheader from  './contentHeader.vue'
export default {
  name: 'layout',
  created () {
  	// 布局内注册的alert confirm 方法
  	var _this = this
  	Vue.prototype.alert = function (options) {
  		if (_this.$refs.alert) {
  			_this.$refs.alert.show(options)
  		}
  	}
  	Vue.prototype.confirm = function (options) {
  		if (_this.$refs.confirm) {
  			_this.$refs.confirm.show(options)
  		}
  	}
  	Vue.prototype.showProgress = function (options) {
  		if (_this.$refs.progress) {
  			return _this.$refs.progress.show(options)
  		}
  	}
  	Vue.prototype.hideProgress = function () {
  		if (_this.$refs.progress) {
  			return _this.$refs.progress.hide()
  		}
  	}
  },
  components: {
    'v-header': header,
    'v-footer': footer,
    'v-main-aside': mainaside,
    'v-content-header': contentheader
  }
}
</script>
