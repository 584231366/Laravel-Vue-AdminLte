<template>
  <div class='row'>
    <div class="col-md-4">
      当前{{ options.current_page }}/{{ options.last_page }} 共{{ options.total }}条记录
     </div>
     <div class="col-md-8">
      <ul class="pagination pagination-sm no-margin pull-right" v-if="options.last_page>1">
        <li v-if="options.current_page>1" v-on:click="doChangePage(1)">
          <a href="javascript:void(0)">&laquo;</a>
        </li>
        <li v-for="p in options.last_page" v-if="Math.abs(options.current_page-p)<= limit" v-on:click="doChangePage(p)" :class="activePage(p)">
          <a href="javascript:void(0)">{{ p }}</a>
        </li>
        <li v-if="options.current_page<options.last_page" v-on:click="doChangePage(options.last_page)">
          <a href="javascript:void(0)" >&raquo;</a>
        </li>
        <li>
          <input type="text" placeholder="页数" v-model="page"/>
          <a href="javascript:void(0)" v-on:click="goPage">跳转</a>
        </li>
      </ul>
     </div>
  </div>
</template>
<script>
export default {
  name: 'components-paginate',
  props: ['options'],
  data () {
    return {
      page: ''
    }
  },
  computed: {
  	limit () {
  		var limit = 3
  		if (this.options.limit) {
  			limit = parseInt(this.options.limit)
  		}
  		return limit
  	}
  },
  methods: {
    doChangePage (page) {
      if (typeof this.options.onPage === 'function') {
        this.options.onPage(page)
      }
    },
    goPage () {
      this.doChangePage(this.page)
    },
    activePage(page) {
    	if (this.options.current_page == page) {
    		return 'active'
    	}
    }
  }
}
</script>
<style scoped>
	input {
		float: left;
	    width: 80px;
	    height: 30px;
	    border: 1px solid #ddd;
	    border-left:0px;
	    padding:0px 10px;
	}
</style>