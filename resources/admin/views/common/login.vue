<template>
	<div class="hold-transition login-page" style="position:absolute;height:100%;width:100%">
		<div class="login-box">
		  <div class="login-logo">
		    <b>后台管理</b>
		  </div>
		  <!-- /.login-logo -->
		  <div class="login-box-body">
		    <p class="login-box-msg">登录</p>

		    <form onsubmit="return false" method="post">
		      <div class="form-group has-feedback">
		        <input type="text" class="form-control" placeholder="邮箱/手机" v-model="params.username">
		        <span class="glyphicon glyphicon-user form-control-feedback"></span>
		      </div>
		      <div class="form-group has-feedback">
		        <input type="password" class="form-control" placeholder="密码" v-model="params.password">
		        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		      </div>
		      <div class="input-group form-group">
                <input type="text" class="form-control" placeholder="验证码" v-model="params.captcha">
                <div class="input-group-addon" style="padding:0px;border-right:0px;border-left:0px;">
                	<img :src="captcha" ref="captcha" style="height:32px" v-if='captcha'/>
                </div>
                <a href="javascript:void(0)" class="input-group-addon" v-on:click="getCaptcha()">
                	<i class="fa fa-refresh fa-spin" v-if="loadingCaptcha"></i>
                	<i class="fa fa-refresh" v-else></i>
                </a>
              </div>
		      <div class="row">
		        <div class="col-xs-8" style="line-height:34px">
		          <input type="checkbox" v-model="remember">记住密码
		        </div>
		        <!-- /.col -->
		        <div class="col-xs-4">
		          <button type="submit" class="btn btn-primary btn-block btn-flat" v-on:click="doLogin()">
		          	<i class="fa fa-spinner fa-pulse" v-if="loging"/> 登录
		          </button>
		        </div>
		        <!-- /.col -->
		      </div>
		    </form>
		  </div>
		  <!-- /.login-box-body -->
		</div>

		<v-alert ref="alert"/>
	</div>
</template>
<script>
import { mapState } from 'vuex'
import config from '../../config.js'
export default{
	name: 'views-common-login',
	data () {
		return {
			params: {
	            'username': '',
	            'password': '',
	            'captcha': '',
	            'key': ''
			},
			remember: false,
			loging: false,
			captcha: null,
			loadingCaptcha: false
		}
	},
	computed: {
	  ...mapState({
	    user: state => state.user,
	    token: state => state.token
	  })
	},
	created () {
		this.getCaptcha()
		if(this.user){
			this.redirect()
		}
	},
	methods: {
		doLogin () {
			var _this = this;
			if(_this.loging){
				return false
			}
			_this.loging = true
			axios.post('/api/v1/login', this.params)
		    .then(response => {
		    	_this.$store.commit('setToken', response.data)
		    	window.axios.defaults.headers.Authorization = _this.token.token_type + " " + _this.token.access_token;
		    	_this.doGetUser();
		    })
		    .catch (response => {
		    	switch(response.response.status){
		    		case 400:;
		    		case 401:
		    			_this.$refs.alert.show({
			    			title: '提示',
			    			msg: '用户名或密码错误！'
			    		});
			    		break;
		    		default: _this.$refs.alert.show({
		    			title: response.response.status,
		    			msg: response.response.status+'错误！'
		    		})
		    	}
		    	_this.loging = false
		    });
		},
		doGetUser(){
			var _this = this;
			axios.get('api/v1/user')
		    .then(response => {
		    	_this.$store.commit('setUser', response.data)
		    	_this.redirect()
		    })
		    .catch (response => {
		    	switch(response.status){
		    		case 400:;
		    		case 401:
		    			_this.$refs.alert.show({
			    			title: '提示',
			    			msg: 'Token无效！'
			    		});
			    		break;
		    		default: _this.$refs.alert.show({
		    			title: response.status,
		    			msg: response.status+'错误！'
		    		})
		    	}
		    	_this.loging = false
		    });
		},
		redirect () {
			if (!this.$route.query.redirect || this.$route.query.redirect == '/login' || this.$route.query.redirect == '/'){
		        // 获取用户菜单默认跳转
		        var _this = this;
                var search = _this.$route.query;
                _this.loading = true
                axios.get('/api/v1/menus/umenus')
                .then(response => {
                	var routes = response.data
                	if(routes.length){ 
	                    for(var i in routes){
	                    	if(routes[i].children == 0){
	                    		_this.$router.push({
					                path: routes[i].route
					            });
					            window.resize();
					            break;
	                    	}
	                    }
                	}else{ 
                		_this.$router.push({
			                path: '404'
			            });
			            window.resize();
                	}
                    _this.loading = false
                })
                .catch (response => {
                    if(response.response){
                        _this.alert({
                            title: '提示',
                            msg: _this.HttpStatusMsg(response.response.status)
                        });
                    }
                    _this.loading = false
                });
			}else{
		        this.$router.push({
		          path: this.$route.query.redirect,
		          query: this.$route.query.query
		        });
		    }
		},
		// 刷新图片验证码
		getCaptcha () {
			var _this = this;
			var url = 'captcha/api/default?' + Math.random(0,10000000)
			_this.loadingCaptcha = true
			axios.get(url)
		    .then(response => {
		    	this.captcha = response.data.img
		    	this.params.key = response.data.key
		    	_this.loadingCaptcha = false
		    })
		    .catch (response => {
		    	switch(response.status){
		    		default: _this.$refs.alert.show({
		    			title: response.status,
		    			msg: response.status+'错误！'
		    		})
		    	}
		    	_this.loadingCaptcha = false
		    });
		}
	}
}
</script>