<template>
  <input v-model='localValue' v-datepicker='datepickerOptions' :disabled="options.disabled"/>
</template>
<script>
export default{
  name: 'form-control-date',
  props: ['options', 'value'],
  data () {
    return {
      localValue: ''
    }
  },
  watch: {
    localValue: 'updateValue',
    value: 'setDefault'
  },
  created () {
    this.setDefault()
  },
  computed: {
    datepickerOptions () {
      return this.options.datepicker?this.options.datepicker:{}
    }
  },
  methods: {
    // 设置初始值
    setDefault () {
      this.localValue = this.value
    },
    // 修改父件的值
    updateValue () {
      this.$emit('input',this.localValue)
    }
  }
}
</script>