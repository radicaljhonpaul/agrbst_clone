<template>
    <span :status="status" :class="classes" style="padding-top: 0.6rem;padding-bottom: 0.6rem;padding-left: 0.8rem;padding-right: 0.8rem;">
        <i class="bi bi-circle-fill"></i> {{ status }}
    </span>
</template>
<script>
    export default {
        props: ['status'],
        mounted(){
            console.log(this.status);
        },
        computed: {
            classes() {
                return this.status == 'approved'
                    ? 'badge approved rounded-pill text-main-green bg-main-green-118-opacity text-capitalize fs-8 fw-light'
                    : 'badge pending rounded-pill text-main-yellow bg-main-yellow-118-opacity text-capitalize fs-8 fw-light'
            }
        },
        methods:{
            
        }
    }
</script>
