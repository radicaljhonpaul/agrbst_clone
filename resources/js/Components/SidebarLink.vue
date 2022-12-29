<template>
  <li class="nav-item">
    <Link :href="href" :method="method" :data="data" :class="classes">
      <slot></slot>
    </Link>
  </li>
</template>

<script>
  import { defineComponent } from 'vue'
  import { Link } from '@inertiajs/inertia-vue3'

  export default defineComponent({
    components: {
      Link,
    },
    
    props: ['href', 'active', 'method', 'data'],

    computed: {
      classes() {
        return this.active
            ? 'nav-link d-flex active justify-content-between fw-bolder'
            : 'nav-link d-flex justify-content-between'
      }
    },
    mounted: function(){
      // console.log(this.method);
    },
    created: function(){
      // console.log(this.data);
    }
  })
</script>
