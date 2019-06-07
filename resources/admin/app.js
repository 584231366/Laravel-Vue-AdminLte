
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import config from './config.js'
import axios from 'axios'
window.$ = window.jQuery = require('./adminlte/bower_components/jquery/dist/jquery.min.js');
require('./adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css');
require('./adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js');
require('./adminlte/bower_components/font-awesome/css/font-awesome.min.css');
require('./adminlte/dist/css/AdminLTE.min.css');
require('./adminlte/dist/css/skins/_all-skins.min.css');
require('./adminlte/dist/js/adminlte.min.js');

require('./vuex/store');
require('./routes/router');
require('./combination/index.js');
window.Vue = require('vue');
window.axios = require('axios');
axios = axios.create({
  baseURL: config.baseURL,
  timeout: 30000,
  headers: {
  	'Authorization': null,
  	'Accept': 'application/json',
  }
});
/**
 * 全局组件
 */
import Alert from './components/global/Alert.vue';
import Confirm from './components/global/Confirm.vue';
import Progress from './components/global/Progress.vue'

Vue.component('v-alert', Alert);
Vue.component('v-confirm', Confirm);
Vue.component('v-progress', Progress);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
    router,
    store,
    template: "<router-view/>",
    created () {
    	this.$store.commit('initVuex')
    }
});
