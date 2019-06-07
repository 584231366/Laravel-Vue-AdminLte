<template>
    <div class="row">
      <div class="col-md-12">
        <form class="box box-info" onsubmit="return false">
            <div class="box-header">
              <h3 class="box-title">
                {{ options.title }}
              </h3>
              <div class="box-tools">
                <div class="input-group input-group-sm text-right">
                  <div class="input-group-btn">
                    <button class='btn btn-default' v-on:click='doSearch()'>
                      <i class='fa fa-search'></i>
                    </button>
                    <button class='btn btn-default' v-for='b in options.btns' v-on:click='triggerCallback(b)'>
                      <i v-if='b.operating' class="fa fa-refresh fa-spin"></i>
                      <template v-else>
                        <span v-if='b.type == "text"'>
                          {{ b.title }}
                        </span>
                        <i v-if='b.type == "icon"' :class='b.icon'></i>
                      </template>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <div>
                <template v-for='c in options.columns'>
                  <div class="col-md-3 mb-5" v-if="!c.type || c.type=='text'">
                    <input type="text" class="form-control"  :placeholder="c.placeholder" v-model='search[c.column]'>
                  </div>
                  <div class="col-md-3" v-if="c.type=='select'">
                    <v-select class="form-control" v-model='search[c.column]' :options="c"/>
                  </div>
                  <div class="col-md-3" v-if="c.type=='date'">
                    <input type="text" class="form-control"  :placeholder="c.placeholder" v-datepicker="{}" v-model='search[c.column]'>
                  </div>
                  <div class="col-md-3" v-if="c.type=='date-range'">
                    <div class="linerlayout-horizontal">
                      <div>
                        <input type="text" class="form-control"  :placeholder="c.placeholder" v-datepicker="{}" v-model='search[c.column + "_from"]'>
                      </div>
                      <div> 至 </div>
                      <div>
                        <input type="text" class="form-control"  :placeholder="c.placeholder" v-datepicker="{}" v-model='search[c.column + "_to"]'>
                      </div>
                    </div>
                  </div>
                </template>
              </div>
              <div style="clear:both"/>
              <br/>
            </div>
        </form>
      </div>
    </div>
</template>
<script>
export default {
  name: 'components-search-form',
  props: ['options'],
  data () {
    return {
      search: {}
    }
  },
  created () {
    var columns = this.options.columns
    for (var i in columns) {
      if (!columns[i].type || columns[i].type === 'text') {
        this.search[columns[i].column] = ''
      }
      if (columns[i].type === 'select') {
        this.search[columns[i].column] = ''
      }
      if (columns[i].type === 'date-range') {
        this.search[columns[i].column + '_from'] = ''
        this.search[columns[i].column + '_to'] = ''
      }
    }
  },
  methods: {
    doSearch () {
      if (typeof this.options.onSearch === 'function') {
        this.options.onSearch(this.search)
      }
    },
    triggerCallback (o) {
      if (typeof o.callback === 'function') {
        o.callback(this.search)
      }
    }
  },
  components: {
    'v-input': require('./control/InputControl.vue'),
    'v-text': require('./control/InputControl.vue'),
    'v-select': require('./control/SelectControl.vue')
  }
}
</script>