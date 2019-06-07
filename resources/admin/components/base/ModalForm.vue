<template>
   <v-modal ref="modal">
   		<template slot="title">{{ options.title }}</template>
   		<template slot="body">
   			<v-form :options="options" v-model="form" :errors="errors"></v-form>
   		</template>
   		<template slot="footer">
   			 <button type="button" class="btn btn-default  pull-left" data-dismiss="modal">关闭</button>
              <button type="button" class="btn btn-default" v-if="submiting">
                <i class="fa fa-spinner fa-pulse"></i> 保存
              </button>
              <button type="button" class="btn btn-default"  v-else v-on:click='saveCallback()'>保存</button>
   		</template>
   </v-modal>
</template>
<script>
import form from './Form.vue'
import modal from '../../components/base/Modal.vue'
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
    show () {
      this.$refs.modal.show()
    },
    hide () {
      this.$refs.modal.hide()
    },
    saveCallback () {
      if (typeof this.options.saveCallback === 'function') {
        this.options.saveCallback()
      }
    }
  },
  components: {
    'v-form': form,
    'v-modal': modal
  }
}
</script>