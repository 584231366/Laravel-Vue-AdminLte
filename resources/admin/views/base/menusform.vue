<template>
    <section class="content">
    	<v-form ref='form' :options='formOptions' :submiting="submiting" v-model="form" :errors="errors"></v-form>
    </section>
</template>

<script>
    import form from '../../components/base/PageForm.vue'
    export default {
    	name: 'menus',
    	data () {
    		return {
                form: {
                    'name': '',
                    'icon': 'fa fa-circle',
                    'route': '/',
                    'display': 0,
                    'pre_id': '',
                    'roles': []
                },
                errors: {},
                submiting: false,
                loading: false,
                menuOptions: [],
                loadingMenuOptions: false,
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
            // 获取菜单
            getData () {
                var _this = this;
                _this.loading = true
                axios.get('/api/v1/menus/' + this.$route.query.id)
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
            // 获下拉/复选数据
            getOptions () {
                var _this = this;
                // 获得菜单数据
                _this.loadingMenuOptions = true
                axios.get('/api/v1/menus/options')
                .then(response => {
                    _this.menuOptions = response.data
                    _this.loadingMenuOptions = false
                })
                .catch (response => {
                    if(response.response){
                        _this.alert({
                            title: '提示',
                            msg: _this.HttpStatusMsg(response.response.status)
                        });
                    }
                    _this.loadingMenuOptions = false
                });
                // 获得角色数据
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
            },
    		// 创建新菜单
    		create (form) {
    			var _this = this;
                _this.submiting = true
                axios.post('/api/v1/menus',_this.form)
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
            // 更新菜单
            update (form) {
                var _this = this;
                _this.submiting = true
                axios.put('/api/v1/menus',_this.form)
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
                    title: '菜单编辑',
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
                            title: '图标',
                            column: 'icon',
                            require: true,
                            type: 'text'
                        },
                        {
                            title: 'Vue路由',
                            column: 'route',
                            require: false,
                            type: 'text'
                        },
                        {
                            title: '排序',
                            column: 'display',
                            require: false,
                            type: 'text'
                        },
                        {
                            title: '父类菜单',
                            column: 'pre_id',
                            require: false,
                            type: 'select',
                            loading: _this.loadingMenuOptions,
                            options: _this.menuOptions
                        },
                        {
                            title: '关联角色',
                            column: 'roles',
                            require: false,
                            type: 'checkbox',
                            loading: _this.loadingRolesOptions,
                            options: _this.rolesOptions
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
