<template>
    <header class="main-header">
	    <!-- Logo -->
	    <a href="javascript:void(0)" class="logo">
	      <!-- mini logo for sidebar mini 50x50 pixels -->
	      <span class="logo-mini"><b>后台</b></span>
	      <!-- logo for regular state and mobile devices -->
	      <span class="logo-lg"><b>后台管理</b></span>
	    </a>
	    <!-- Header Navbar: style can be found in header.less -->
	    <nav class="navbar navbar-static-top">
	      <!-- Sidebar toggle button-->
	      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </a>
	
	      <div class="navbar-custom-menu">
	        <ul class="nav navbar-nav">
	          <v-envelope v-if="hasPermission('admin.messages.personal')"></v-envelope>
	          <li class="dropdown user user-menu">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	              <img src="../../adminlte/dist/img/default_avatar.png" class="user-image" alt="User Image">
	              <span class="hidden-xs">{{ $store.state.user.name }}</span>
	            </a>
	            <ul class="dropdown-menu">
	              <!-- User image -->
	              <li class="user-header">
	                <img src="../../adminlte/dist/img/default_avatar.png" class="img-circle" alt="User Image">
	
	                <p>
	                  {{ $store.state.user.name }}
	                  <small>
		                  {{ $store.state.user.email }}
		                </small>
	                </p>
	              </li>
	              <!-- Menu Footer-->
	              <li class="user-footer">
	                <div class="pull-left">
	                  <a href="javascript:void(0)" class="btn btn-default btn-flat" v-on:click="showForm()">修改密码</a>
	                </div>
	                <div class="pull-right">
	                  <a href="javascript:void(0)" v-on:click="logout()" class="btn btn-default btn-flat">登出</a>
	                </div>
	              </li>
	            </ul>
	          </li>
	        </ul>
	      </div>
	    </nav>
	    
	    <v-alert ref="alert"></v-alert>
	    <v-form v-model="form" :errors="errors" :options="formOptions" :submiting="submiting" ref="form"></v-form>
	  </header>
</template>

<script>
	import form from '../../components/base/ModalForm'
    import envelope from './header_envelope.vue'
    export default {
    	name: 'app-header',
    	data () {
    		return {
    			form: {},
    			errors: {},
    			submiting: false
    		}
    	},
    	methods: {
    		showForm () {
    			this.errors = {}
				this.$refs.form.show()
    		},
    		changePassword () {
    			var _this = this;
    			_this.submiting = true;
    			axios.put('/api/v1/user/resetpassword',_this.form)
    			.then(response => {
                    _this.alert({
                        title: '提示',
                        msg: '数据已保存！'
                    });
                    _this.submiting = false
                    _this.$refs.form.hide()
                })
                .catch (response => {
                    if(response.response){
                        _this.alert({
                            title: '提示',
                            msg: _this.HttpStatusMsg(response.response.status)
                        });
                        if(response.response.status == 400){
                            _this.errors = response.response.data.errors
                        }
                    }
                    _this.submiting = false
                });
    		},
    		logout () {
    			this.$store.commit('clearState');
    			window.location.reload()
    		}
    	},
    	computed: {
    		formOptions () {
    			var _this = this;
    			return {
    				title: '修改密码',
    				columns: [
    					{
    						title: '新密码',
    						column: 'password',
    						type: 'password'
    					},
    					{
    						title: '重复密码',
    						column: 'password_confirmation',
    						type: 'password'
    					}
    				],
	    			saveCallback () {
	    				_this.changePassword()
	    			}
    			}
    		}
    	},
    	components: {
    		'v-form': form,
    		'v-envelope': envelope
    	}
    }
</script>
