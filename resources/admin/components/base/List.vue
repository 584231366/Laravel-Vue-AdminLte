<template>
  <div>
    <div v-if="options == null" class="row">
      <div class="col-md-12 text-center">
        请设置数据！
      </div>
    </div>
    <div class="row" v-else>
      <div class="col-md-12">
      <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">
              	{{ options.title }}
              </h3>
              <div class="box-tools">
                <div class="input-group input-group-sm " style="width: 250px;text-align:right">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search" v-model="keyword" v-if="searchAble">

                  <form class="input-group-btn" onclick="return false">
                    <button type="submit" class="btn btn-default" v-on:click="doSearch()" v-if="searchAble"><i class="fa fa-search"  ></i></button>
                    <template v-if='options.operations'>
                    	<template  v-for='o in options.operations'>
	                    	<a class="btn btn-default" v-on:click='triggerCallback(o)'>
		                    	<i v-if='o.icon' :class="o.icon"></i> {{ o.title }}
		                    </a>
	                    </template>
                    </template>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <v-table 
                :titles='options.titles'
                :columns='options.columns'
                :data='list.data?list.data:[]'
                :loading='loading'
                :sort='options.sort'
                :sortCallback='options.onSort'
              />
            </div>
            <div class="box-footer" v-if="list">
            	<v-paginate :options='paginateOptions'></v-paginate>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import table from './Table.vue'
import paginate from './Paginate.vue'
export default {
  name: 'components-list',
  props: ['options', 'list', 'loading'],
  data () {
    return {
      keyword: ''
    }
  },
  created () {
  	this.keyword = this.$route.query.keyword
  },
  computed: {
    paginateOptions () {
      var _this = this
      var options = {
        current_page: _this.list.current_page,
        last_page: _this.list.last_page,
        total: _this.list.total,
        onPage (page) {
          if (typeof _this.options.onPage === 'function') {
            _this.options.onPage(page)
          }
        }
      }
      return options
    },
    searchAble () {
      if (typeof this.options.onSearch === 'function') {
        return true
      } else {
        return false
      }
    }
  },
  methods: {
    doSearch () {
      if (this.searchAble) {
        this.options.onSearch(this.keyword)
      }
    },
    triggerCallback (o) {
      o.callback()
    }
  },
  components: {
    'v-table': table,
    'v-paginate': paginate
  }
}
</script>