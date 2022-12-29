<template>
    <div :accumulatedAmount="accumulatedAmount" :periodFrom="periodFrom" :periodTo="periodTo" class="flex-fill pending-accounts rounded-8 section-hoverable ps-4 py-3 pe-4">
        <div class="">
            <p class="text-wrap fs-7 fw-bold mb-0 text-break">Accumulated Orders</p>
            <span class="fs-8 fst-italic"> (Last week, 06/01/22 - 06/08/22 ) </span>
        
            <p class="text-wrap text-break align-self-end mb-0">
                <span class="fs-3">
                    {{ '₱' + this.MondeyDigitFormat(340250.93)}}
                </span>
            </p>
        </div>
    </div>
</template>
<script>
    import { Link } from '@inertiajs/inertia-vue3'
    import Helpers from '../../Mixins/Helpers.js'

    export default {
        
        components: {
            Link,
        },
        mixins: [Helpers],
        props: ['accumulatedAmount', 'periodFrom', 'periodTo'],
        methods:{
            
        },
        created(){
            // console.log(this.accumulatedAmount);
        },
        methods: {
        }
    }
</script>
