<template>
    <div :orderCommodity="orderCommodity" class="rounded-8 pending-accounts px-4 pt-4 pb-0 h-100">
        <div :tableData="tableData" class="row px-0 py-0 mb-2 justify-content-between">
            <div class="col-6">
                <p class="fw-bold mb-0" > Orders <i class="bi bi-card-list"></i> </p>
            </div>
            <div class="col-6 text-end">
                <p class="fw-bold mb-0"> 
                    <a href="#" class="text-decoration-none text-main-green"> <i class="bi bi-box-arrow-up-right fw-bold fs-7"></i> </a> 
                </p>
            </div>
        </div>

        <div class="container-fluid pt-4 px-0">
            <div class="d-flex flex-wrap justify-content-between">
                <div class="rounded-8 shadow p-3">
                    <span class="fs-8 text-main-green text-capitalize fw-light" >
                        <i class="bi bi-circle-fill"></i> {{ "Received last" }}
                    </span>
                    <p class="fs-8"> 
                        {{ "Wed ,Jun 15 2022" }}
                    </p>
                    <p class="fw-bold fs-7 mb-0"> Ampalaya </p>
                    <p class="mb-0 fs-8"> {{ "Variety 1, Class A" }} </p>
                    <p class="mb-0 fs-8"> {{ "₱65.33 / kg" }} </p>
                    <p class="mt-3 fs-5 fw-bold mb-0"> {{ "69.33 kg" }} </p>
                </div>
                <div class="rounded-8 shadow p-3">
                    <span class="fs-8 text-main-green text-capitalize fw-light" >
                        <i class="bi bi-circle-fill"></i> {{ "Received last" }}
                    </span>
                    <p class="fs-8"> 
                        {{ "Wed ,Jun 15 2022" }}
                    </p>
                    <p class="fw-bold fs-7 mb-0"> Ampalaya </p>
                    <p class="mb-0 fs-8"> {{ "Variety 1, Class A" }} </p>
                    <p class="mb-0 fs-8"> {{ "₱65.33 / kg" }} </p>
                    <p class="mt-3 fs-5 fw-bold mb-0"> {{ "69.33 kg" }} </p>
                </div>
                <div class="rounded-8 shadow p-3">
                    <span class="fs-8 text-main-yellow fw-light" >
                        <i class="bi bi-circle-fill"></i> {{ "Delivery on" }}
                    </span>
                    <p class="fs-8"> 
                        {{ "Wed ,Jun 15 2022" }}
                    </p>
                    <p class="fw-bold fs-7 mb-0"> Kalabasa </p>
                    <p class="mb-0 fs-8"> {{ "Variety 1, Class A" }} </p>
                    <p class="mb-0 fs-8"> {{ "25.33 / kg" }} </p>
                    <p class="mt-3 fs-5 fw-bold mb-0"> {{ "100.33 kg" }} </p>
                </div>
                <div class="rounded-8 shadow p-3">
                    <span class="fs-8 text-main-green text-capitalize fw-light" >
                        <i class="bi bi-circle-fill"></i> {{ "Received last" }}
                    </span>
                    <p class="fs-8"> 
                        {{ "Wed ,Jun 15 2022" }}
                    </p>
                    <p class="fw-bold fs-7 mb-0"> Ampalaya </p>
                    <p class="mb-0 fs-8"> {{ "Variety 1, Class A" }} </p>
                    <p class="mb-0 fs-8"> {{ "₱65.33 / kg" }} </p>
                    <p class="mt-3 fs-5 fw-bold mb-0"> {{ "69.33 kg" }} </p>
                </div>
                <div class="rounded-8 shadow p-3">
                    <span class="fs-8 text-main-green text-capitalize fw-light" >
                        <i class="bi bi-circle-fill"></i> {{ "Received last" }}
                    </span>
                    <p class="fs-8"> 
                        {{ "Wed ,Jun 15 2022" }}
                    </p>
                    <p class="fw-bold fs-7 mb-0"> Ampalaya </p>
                    <p class="mb-0 fs-8"> {{ "Variety 1, Class A" }} </p>
                    <p class="mb-0 fs-8"> {{ "₱65.33 / kg" }} </p>
                    <p class="mt-3 fs-5 fw-bold mb-0"> {{ "69.33 kg" }} </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { Link } from '@inertiajs/inertia-vue3'

    export default {
        
        components: {
            Link,
        },
        props: ['orderCommodity'],
        methods:{
            
        },
        created(){
            console.log(this.orderCommodity);
        },
        methods: {
        }
    }
</script>
