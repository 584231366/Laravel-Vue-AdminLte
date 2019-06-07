<template>
    <section class="content">
    	<v-form ref='form' :options='formOptions' :submiting="submiting" v-model="form" :errors="errors"></v-form>
    </section>
</template>

<script>
    import form from '../../components/base/PageForm.vue'
    export default {
    	name: 'users',
    	data () {
    		return {
                form: {
                    'name': '',
                    'email': '',
                    'mobile': ''
                },
                errors: {},
                submiting: false,
                loading: false,
                rolesOptions: [],
                loadingRolesOptions: false
    		}
    	},
        created () {
            this.getOptions()
            if (this.$route.query.id) {
                this.getData()
            }
        },
    	methods: {
            // 获取用户
            getData () {
                var _this = this;
                _this.loading = true
                axios.get('/api/v1/users/' + this.$route.query.id)
                .then(response => {
                    _this.form = response.data
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
            },
    		// 创建新用户
    		create (form) {
    			var _this = this;
                _this.submiting = true
                axios.post('/api/v1/users',_this.form)
                .then(response => {
                    _this.alert({
                        title: '提示',
                        msg: '数据已保存！'
                    });
                    _this.$router.go(-1)
                    _this.submiting = false
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
            // 更新用户
            update (form) {
                var _this = this;
                _this.submiting = true
                axios.put('/api/v1/users',_this.form)
                .then(response => {
                    _this.alert({
                        title: '提示',
                        msg: '数据已保存！'
                    });
                    _this.$router.go(-1)
                    _this.submiting = false
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
            // 获取角色下拉数据
            getOptions () {
                var _this = this;
                _this.loadingRolesOptions = true
                axios.get('/api/v1/roles/options')
                .then(response => {
                    _this.rolesOptions = response.data
                    _this.loadingRolesOptions = false
                })
                .catch (response => {
                    if(response.response){
                        _this.alert({
                            title: '提示',
                            msg: _this.HttpStatusMsg(response.response.status)
                        });
                    }
                    _this.loadingRolesOptions = false
                });
            }
    	},
    	computed: {
    		formOptions () {
                var _this = this;
                var options =  {
                    title: '用户编辑',
                    showStatus: true,
                    data: _this.form,
                    loading: _this.loading,
                    columns: [
                        {
                            title: '名称',
                            column: 'name',
                            require: true,
                            type: 'text'
                        },
                        {
                            title: '邮箱',
                            column: 'email',
                            require: true,
                            type: 'text'
                        },
                        {
                            title: '手机',
                            column: 'mobile',
                            require: true,
                            type: 'text'
                        },
                        {
                            title: '角色',
                            column: 'roles',
                            require: false,
                            type: 'checkbox',
                            loading: _this.loadigRolesOptions,
                            options: _this.rolesOptions
                        },
                        {
                            title: '密码',
                            column: 'password',
                            require: this.$route.query.id?false:true,
                            type: 'text'
                        },
                        {
                            title: '重复密码',
                            column: 'password_confirmation',
                            require: this.$route.query.id?false:true,
                            type: 'text'
                        }
                    ],
                    saveCallback () {
                        var form = _this.form
                        if (form.id) {
                            _this.update(form)
                        } else {
                            _this.create(form)
                        }
                    },
                    cancelCallback () {
                        _this.$router.go(-1)
                    }
                }
                return options
    		}
    	},
    	components: {
    		'v-form': form
    	}
    }
</script>
