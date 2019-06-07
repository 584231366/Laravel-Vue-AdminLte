<template>
  <section>
	  <div class="box box-info">
      <div class="overlay" v-if="options.loading">
        <i class="fa fa-spinner fa-pulse"></i>
      </div>
	    <div class="box-header with-border">
	      <h3 class="box-title" v-if="options.title">{{options.title}}</h3>
	    </div>
	    <!-- /.box-header -->
	    <!-- form start -->
	      <div class="box-body">
	        	<v-form ref='form' :options="options" v-if="!options.loading" :errors="errors" v-model="form"></v-form>
	      </div>
	      <!-- /.box-body -->
	      <div class="box-footer">
	         <button type="submit" class="btn btn-default" v-on:click='cancelCallback()'>取消</button>
              <button type="submit" class="btn btn-default pull-right" v-if="submiting">
                <i class="fa fa-spinner fa-pulse"></i> 保存
              </button>
              <button type="submit" class="btn btn-default pull-right"  v-else v-on:click='saveCallback()'>保存</button>
	      </div>
	      <!-- /.box-footer -->
	  </div>
  </section>
</template>
<script>
  import form from './Form.vue'
  export default {
    name: 'components-modal-form',
    props: ['options', 'submiting', 'value', 'errors'],
    data () {
      return {
        form: {}
      }
    },
    watch: {
      form: {
        handler () {
          this.$emit('input',this.form)
        },
        deep: true
      },
      value: {
        handler () {
          this.form = this.value
        },
        deep: true
      }
    },
    created () {
      this.form = this.value
    },
    methods: {
      saveCallback () {
        if (typeof this.options.saveCallback === 'function') {
          this.options.saveCallback()
        }
      },
      cancelCallback () {
        if (typeof this.options.cancelCallback === 'function') {
          this.options.cancelCallback()
        }
      }
    },
    components: {
      'v-form': form
    }
  }
</script>