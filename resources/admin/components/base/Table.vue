<template>
  <table class="table table-hover" v-if='showTable'>
    <thead>
      <tr>
        <th v-for='t in localTitles'>
        	<a href="javascript:void(0)" v-if="t.sort" v-on:click="changeSort(t.column)">{{ t.text }} <i :class="t.icon"></i></a>
        	<template v-else>
        		{{ t.text }}
        	</template>
        </th>
      </tr>
    </thead>
    <tbody v-if="loading">
      <td :colspan='colspan' class='text-center'>
        <i class='fa fa-spinner fa-pulse'></i> 数据加载中
      </td>
    </tbody>
    <tbody v-else>
      <tr v-for='d in data' v-if="!d.deleted_at">
        <td v-for='c in columns' v-html="(typeof d[c] !== 'undefined')?d[c]: '字段' + c + '不存在'"></td>
        <td v-if='d.operations' class="text-right">
        	<template v-if='d.operating'>
        	  <i class='fa fa-spin fa-refresh'></i>
        	</template>
        	<template v-else>
        		<template v-for='(o, k) in d.operations'>
        			<template v-if="k">&nbsp;</template>
        			<a href="javascript:void(0)"  v-if='showOperation(o)' v-on:click='triggerCallback(o)'>{{ o.title }}</a>
        		</template>
        	</template>
        </td>
      </tr>
    </tbody>
  </table>
</template>
<script>
export default {
  name: 'components-table',
  props: ['titles', 'columns', 'data', 'loading', 'sort', 'sortCallback'],
  data () {
    return {
    	sortData: {
    		sort_by: '',
    		sort_type: ''
    	}
    }
  },
  computed: {
    colspan () {
      var num = this.titles.length + 1
      return num
    },
    localTitles () {
    	var titles = [];
    	for (var i in this.titles) {
    		titles.push({
    			text: this.titles[i],
    			column: this.columns[i],
    			sort: this.ableSort(this.columns[i]),
    			icon: this.sortIcon(this.columns[i])
    		})
    	}
    	return titles
    },
    showTable () {
      var bool = this.titles && this.columns && this.data
      if (!bool) {
        if (!this.titles) {
          console.log('组件错误：Table组件缺少titles参数！')
        }
        if (!this.columns) {
          console.log('组件错误：Table组件缺少columns参数！')
        }
        if (!this.data) {
          console.log('组件错误：Table组件缺少data参数！')
        }
      }
      return bool
    }
  },
  methods: {
    triggerCallback (o) {
      o.callback()
    },
    showOperation (o) {
      if (typeof o.show === 'function') {
        return o.show()
      }
      return true
    },
    ableSort (column) {
    	if (this.sort) {
    		for(var i in this.sort) {
    			if (this.sort[i] == column) {
    				return true
    			}
    		}
    	}
    	return false
    },
    sortIcon (column) {
    	var sort = 'fa fa-sort';
    	if (this.sortData.sort_by == column) {
    		if (this.sortData.sort_type == 'asc') {
    			 sort = 'fa fa-sort-asc'
    		}else{
    			 sort = 'fa fa-sort-desc'
    		}
    	}
    	return sort
    },
    changeSort (sort_by) {
    	if (this.sortData.sort_by == sort_by) {
    		if (this.sortData.sort_type == 'asc') {
    			this.sortData.sort_type = 'desc'
    		}else{
    			this.sortData.sort_type = 'asc'
    		}
    	}else{
    		this.sortData.sort_by = sort_by
    		this.sortData.sort_type = 'asc'
    	}
    	if (typeof this.sortCallback == 'function') {
    		this.sortCallback(this.sortData)
    	}
    }
  }
}
</script>