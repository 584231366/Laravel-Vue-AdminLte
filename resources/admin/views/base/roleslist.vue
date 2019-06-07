<template>
    <section class="content">
    	<v-list :options="listOptions" :loading="loading" :list="list" ></v-list>
    </section>
</template>

<script>
    import list from '../../components/base/List'
    export default {
    	name: 'roles',
    	data () {
    		return {
    			list: {},
    			loading: false
    		}
    	},
    	created () {
    		this.getList();
    	},
    	watch: {
    		'$route'(to, from) {
    			this.getList();
    		}
    	},
    	methods: {
    		// 获取角色列表
    		getList () {
    			var _this = this;
    			var search = _this.$route.query;
                search.limit = 10
                _this.loading = true
                axios.get('/api/v1/roles?' + $.param(search))
                .then(response => {
                    var list = response.data
                    for (var d in list.data) {
                        _this.supplementOperations(list.data[d])
                    }
                    _this.list = list
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
    		// 记录操作
    		supplementOperations (data) {
    			  var _this = this
				  data.operations = [
                    {
                      title: '编辑',
                      callback () {
                        _this.$router.push({
                            path: '/admin/roles/form',
                            query: {'id': data.id}
                        })
                      }
                    },
				    {
				      title: '删除',
				      callback () {
				        _this.confirm({
				      		msg: '确认删除数据？',
				      		onConfirm () {
				      			_this.delete(data);
				      		}
				      	});
				      }
				    }
				  ]
    		},
    		// 删除角色
    		delete (data) {
    			var _this = this;
                data.deleting = true
    			axios.delete('/api/v1/roles?id='+data.id)
                .then(response => {
                    _this.alert({
                        title: '提示',
                        msg: '数据已删除！'
                    });
                    _this.getList()
                    data.deleting = false
                })
                .catch (response => {
                    if(response.response){
                        if(response.response.status == 400){
                            _this.alert({
                                title: '提示',
                                msg: _this.HttpStatusMsg(response.response.data.message)
                            });
                        }else{
                            _this.alert({
                                title: '提示',
                                msg: _this.HttpStatusMsg(response.response.status)
                            });
                        }
                    }
                    data.deleting = false
                });
    		}
    	},
    	computed: {
    		listOptions () {
    			var _this = this;
    			return {
    				title: '角色列表',
    				titles: ['角色', '描述', '标签', '创建时间'],
                    columns: ['name','desc','tag','created_at'],
    				onSearch (keyword) {
    					_this.$router.push({
    						path: _this.$route.path,
    						query: {'keyword': keyword}
    					});
    				},
    				onPage (page) {
    					var query = {};
    					for (var k in _this.$route.query) {
    						query[k] =  _this.$route.query[k]
    					}
    					query.page = page;
    					_this.$router.push({
    						path: _this.$route.path,
    						query:  query
    					});
    				},
    				operations: [
    					{
    						icon: 'fa fa-plus',
    						position: 'list',
    						callback () {
    							_this.$router.push({
                                    path: '/admin/roles/form'
                                })
    						}
    					}
    				]
    			}
    		}
    	},
    	components: {
    		'v-list': list
    	}
    }
</script>
