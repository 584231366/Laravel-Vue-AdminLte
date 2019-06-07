<template>
    <section class="content-header">
      <h1>
        {{ title }}
      </h1>
      <ol class="breadcrumb">
      	<template v-for="b in breadcrumb">
      		<li>
      			<i :class="b.icon" v-if="b.icon"></i>
      			{{b.title}}
      		</li>
      	</template>
      </ol>
    </section>
</template>

<script>
    export default {
    	name: 'content-guid',
    	computed: { // 通过mainAside 获取信息
    		title () {
    			return this.$parent.$refs.menus.contentHeader.title
    		},
    		breadcrumb () {
    			return this.$parent.$refs.menus.contentHeader.breadcrumb
    		}
    	}
    }
</script>
