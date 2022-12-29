<template>
    <div :userID="userID" class="d-flex flex-wrap pending-accounts justify-content-start rounded-8 section-hoverable h-100 ps-4 pt-3 pb-3 pe-4 ">
        <div class="w-100">
            <div class="d-flex fs-5 justify-content-between">
                <p class="fw-bold mb-0"> Featured Transaction <i class="bi bi-trophy"></i> </p>
                <a href="#" class="text-decoration-none text-main-green"> <i class="bi bi-box-arrow-up-right fw-bold fs-7"></i> </a>
            </div>
        </div>
        
        <div class="">
            <img src="/images/Profile.jpg" class="img-fluid bg-white rounded-8 section-hoverable" style="width:160px;height:100%;object-fit: cover;" alt="">
        </div>

        <div class="ps-3 flex-fill">
            <div class="d-flex">
                <div class="px-2 flex-fill">
                    <p class="fst-italic mb-0">
                        Transaction No.
                    </p>
                    
                    <p class="fst-italic fs-8 mb-0">
                        {{ "BXU-010202-02072022-2022-0001" }}
                    </p>
                    <p class="fw-bold mb-0">Ampalaya</p>
                    <span class=""> {{ "₱65.33 / kg, Variety 1, Class A" }} </span>
                </div>
                <div class="flex-fill text-end">
                    <p class="mb-0 fw-bold fs-7">Delivered On</p>
                    <p class=""> {{ "Tue, 05/03.2022" }} </p>
                </div>
            </div>

            <div class="d-flex mt-3">
                <div class="px-2 flex-fill">
                    <div class="d-flex">
                        <div class="flex-fill">
                            <p class="mb-0 fw-bold fs-7">Qty</p>
                            <p class="mb-0"> {{ "5,500.00 kg" }} </p>
                        </div>
                        <div class="flex-fill">
                            <p class="mb-0 fw-bold fs-7">Commitment</p>
                            <p class="mb-0"> {{ "3,500.00 kg" }} </p>
                        </div>
                    </div>
                </div>
                <div class="flex-fill text-end">
                    <p class="mb-0 fw-bold fs-7">Total Sales</p>
                    <p class="mb-0"> {{ "₱ 228,655.00" }} </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { Link } from '@inertiajs/inertia-vue3'
    import Helpers from '../Mixins/Helpers.js'

    export default {
        
        components: {
            Link,
        },
        mixins: [Helpers],
        props: ['transactionData', 'userID'],
        methods:{
            
        },
        created(){
            console.log(this.accumulatedAmount);

            
        },
    }
</script>
