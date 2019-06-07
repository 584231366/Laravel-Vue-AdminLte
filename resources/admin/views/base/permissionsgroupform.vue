<template>
    <section class="content">
    	<v-form ref='form' :options='formOptions' :submiting="submiting" v-model="form" :errors="errors"></v-form>
    </section>
</template>

<script>
    import form from '../../components/base/PageForm.vue'
    export default {
    	name: 'permissionsgroup',
    	data () {
    		return {
                form: {
                    'name': '',
                    'routes': []
                },
                errors: {},
                submiting: false,
                loading: false,
                routesOptions: [],
                loadingRoutesOptions: false
    		}
    	},
        created () {
            this.getOptions()
            if (this.$route.query.id) {
                this.getData()
            }
        },
    	methods: {
            // 获取权限组
            getData () {
                var _this = this;
                _this.loading = true
                axios.get('/api/v1/permissionsgroup/' + this.$route.query.id)
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
            // 获取复选框数据
            getOptions () {
                var _this = this;
                _this.loadingRoutesOptions = true
                axios.get('/api/v1/routes/options')
                .then(response => {
                    _this.routesOptions = response.data
                    _this.loadingRoutesOptions = false
                })
                .catch (response => {
                    if(response.response){
                        _this.alert({
                            title: '提示',
                            msg: _this.HttpStatusMsg(response.response.status)
                        });
                    }
                    _this.loadingRoutesOptions = false
                });
            },
    		// 创建新权限组
    		create (form) {
    			var _this = this;
                _this.submiting = true
                axios.post('/api/v1/permissionsgroup',_this.form)
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
            // 更新权限组
            update (form) {
                var _this = this;
                _this.submiting = true
                axios.put('/api/v1/permissionsgroup',_this.form)
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
            }
    	},
    	computed: {
    		formOptions () {
                var _this = this;
                var options =  {
                    title: '权限组编辑',
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
                            title: '路由',
                            column: 'routes',
                            require: false,
                            type: 'checkbox',
                            loading: _this.loadingRoutesOptions,
                            options: _this.routesOptions
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
