<template>
  <form onsubmit='return false' role='form'>
    <template v-for='c in options.columns'>
      <div :class="(errors && errors[c.column])?'form-group has-error':'form-group'">
        <label><span v-if="c.require" style="color:red">*</span>{{ c.title }}</label>
        <components :is="'v-'+c.type" :options="c" v-model="form[c.column]" class="form-control" :placeholder="c.placeholder"/>
        <strong v-if="c.memo">{{c.memo}}</strong>
        <span class="help-block" v-if="errors && errors[c.column]">{{ errors[c.column][0] }}</span>
      </div>
    </template>
  </form>
</template>
<script>
import image from './control/ImageControl.vue'
import input from './control/InputControl.vue'
import text from './control/InputControl.vue'
import textarea from './control/TextareaControl.vue'
import select from './control/SelectControl.vue'
import password from './control/PasswordControl.vue'
import date from './control/DateControl.vue'
import file from './control/FileControl.vue'
import checkbox from './control/CheckboxControl.vue'
export default {
  name: 'components-form',
  props: ['options','value','errors'],
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
    this.$forceUpdate()
  },
  components: {
    'v-image': image,
    'v-input': input,
    'v-text': input,
    'v-textarea': textarea,
    'v-select': select,
    'v-password': password,
    'v-date': date,
    'v-file': file,
    'v-checkbox': checkbox
  }
}
</script>