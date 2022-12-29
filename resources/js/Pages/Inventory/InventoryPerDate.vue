<template>
    <link rel="stylesheet" href="../../css/table.css">
    <link rel="stylesheet" href="../../css/content.css">

    <component :is="layout">
        <div class="container-fluid">
            <section class="d-flex justify-content-between mt-0 mb-0 mx-2">
                <div class="mb-2">
                    <p class="fs-6 mb-0 fw-bolder text-capitalize" v-text="'Inventory & Orders'"></p> 
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 fs-8">   
                            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" :href="route('Agrihub.AgriHubDashboardIndex')" >Dashboard</a></li>
                            <li class="breadcrumb-item active" role="button" @click="this.go_back()" aria-current="page">Inventory & Orders</li>
                            <li class="breadcrumb-item active" aria-current="page">Date</li>
                        </ol>
                    </nav>
                </div>
                <div class="align-self-center">
                    <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#filterModal" id="button-addon2"> Filter <i class="bi bi-filter"></i> </button>
                </div>
            </section>

            <section class="row bg-white mb-2 mt-0 mx-2 rounded-8 py-4">
                
                <div class="col-12">
                    <!-- First Row -->
                    <div class="row justify-content-between">
                        <div class="col d-flex flex-column">
                            <div>
                                <label class="fs-8">Commodity</label>
                                <p class="fs-6 fw-bold mb-0">{{ Demands[0].crop.name }}</p>

                                <div class="d-flex gap-3 fst-italic">
                                    <div class="fs-7 mb-0">
                                        <span v-if="Demands[0].class_id != null">
                                            {{ 'Class: ' + Demands[0].class_id }}
                                        </span>
                                        <span v-else>
                                            {{ 'Class: None'}}
                                        </span>
                                    </div>
                                    <div class="fs-7 mb-0">
                                        <span v-if="Demands[0].class_id != null">
                                            {{ 'Variety: ' + Demands[0].variety_id }}
                                        </span>
                                        <span v-else>
                                            {{ 'Variety: None'}}
                                        </span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col d-flex flex-column">
                            <label class="fs-8">Delivery Date</label>
                            <p class="fs-6 fw-bold">{{ this.DateFormatDateOnly(Demands[0].date) }}</p>
                        </div>
                        
                        <div class="col d-flex flex-column">
                            <div>
                                <label class="fs-8">Quantity</label>
                                <p class="fs-6 fw-bold">{{ Demands[0].consolidated_qty + ' kg' }}</p>
                            </div>
                        </div>

                        <div class="col">
                            <label class="fs-8">Amount</label>
                            <p class="fs-6 fw-bold">{{ this.MondeyDigitFormat(Demands[0].consolidated_amount) }}</p>
                        </div>
                    </div>
                    <hr>

                    <!-- Second Row -->
                    <div class="row justify-content-between">
                        <div class="col d-flex flex-column gap-2">

                            <div class="p-2 align-items-end border-bottom border-1" style="height:90px;">
                                <label for="" class="fs-7">
                                    Demands
                                </label>

                                <div class="d-flex gap-2 justify-content-between">
                                    <div class="d-flex flex-column mb-0 align-self-end">
                                        <div>
                                            <span class="badge rounded-pill bg-secondary fw-light"> {{ 'Trader Composition: ' +Demands[0].demands.length }} </span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column mb-0 align-self-start">
                                        <div class="fs-4 fw-bold">
                                            {{ Demands[0].consolidated_qty + ' kg' }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-2 align-items-end border-bottom border-1" style="height:90px;">
                                <label for="" class="fs-7">
                                    Supply
                                </label>
                            </div>

                            <div class="p-2 align-items-end border-bottom border-1" style="height:90px;">
                                <label for="" class="fs-7">
                                    For Harvest
                                </label>

                            </div>
                        </div>

                        <div class="col d-flex flex-column gap-2">
                            <div class="p-2 align-items-end border-bottom border-1" style="height:90px;">
                                <label for="" class="fs-7">
                                    Recurring Balance
                                </label>

                            </div>

                            <div class="p-2 align-items-end border-bottom border-1" style="height:90px;">
                                <label for="" class="fs-7">
                                    Forcasted On-hand
                                </label>
                            </div>
                        </div>

                        <div class="col d-flex flex-column gap-2">
                            <div class="p-2 d-flex justify-content-between border-bottom border-1" style="height:90px;">
                                <div>
                                    <p class="fs-7 mb-0">
                                        FGP
                                    </p>
                                    <p class="fs-9 mb-0">
                                        (Farmgate Price)
                                    </p>
                                </div>

                                <div>
                                    <p class="fs-7 mb-0">
                                        SMP
                                    </p>
                                    <p class="fs-9 mb-0">
                                        (Social Market Price)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </section>
        </div>
    </component>

    <!-- Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    
                    <div class="col-12 my-1">
                        <label for="" class="fs-7">
                            Crop
                        </label>
                        <Multiselect
                            v-model="this.value"
                            placeholder="Select..."
                            label="name"
                            trackBy="name"
                            :options="this.options"
                            :searchable="true"
                            >
                        </Multiselect>
                    </div>

                    <div class="col-12 my-1">
                        <label for="" class="fs-7">
                            Class
                        </label>
                        <Multiselect
                            v-model="this.value"
                            placeholder="Select..."
                            label="name"
                            trackBy="name"
                            :options="this.options"
                            :searchable="true"
                            >
                        </Multiselect>
                    </div>

                    <div class="col-12 my-1">
                        <label for="" class="fs-7">
                            Variety
                        </label>
                        <Multiselect
                            v-model="this.value"
                            placeholder="Select..."
                            label="name"
                            trackBy="name"
                            :options="this.options"
                            :searchable="true"
                            >
                        </Multiselect>
                    </div>

                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-outline-main-2" data-bs-dismiss="modal">Close <i class="bi bi-x-circle"></i></button>
                <button type="button" class="btn btn-sm btn-outline-main-1">Apply filter <i class="bi bi-funnel"></i></button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AgrihubLayout from '@/Layouts/AgrihubLayout.vue'
    import CaGoLayout from '@/Layouts/CaGoLayout.vue'
    import Modal from '@/Jetstream/Modal'
	import Swal from 'sweetalert2'
    import TablePagination from '../../Components/TablePagination.vue'
    import TableComponent from '../../Components/Table.vue'
    import { shallowRef } from "vue"; 
    import { Link } from '@inertiajs/inertia-vue3'
    import Helpers from '../../Mixins/Helpers.js'
    import InventoryAndOrdersCalendar from '../../Components/Calendar.vue'
    import Multiselect from '@vueform/multiselect'

    export default {
        components: {
            AgrihubLayout,
            CaGoLayout,
            Modal,
            Swal,
            TableComponent,
            TablePagination,
            Link,
            InventoryAndOrdersCalendar,
            Multiselect
        },
        mixins: [Helpers],
        props: ['Demands', 'RoutePrefix'],
		data() {
            const month = new Date().getMonth();
            const year = new Date().getFullYear();
			return {
                layout: shallowRef('div'),
                value: null,
                options: [
                    'Bitter Gourd',
                    'Tomato',
                    'Eggplant',
                ]
            }
        },
        methods: {
            sTringify(data){
                return JSON.stringify(data);
            },

        },
        created: function(){
            console.log("Demands");
            console.log(this.Demands);

            if(this.RoutePrefix == 'CaGo'){
                this.layout = CaGoLayout;
                console.log("<ca-go-layout>");
            }else if(this.RoutePrefix == 'Agrihub'){
                this.layout = AgrihubLayout;
                console.log("<agrihub-layout>");
            }
        }
    }
</script>

<style src="@vueform/multiselect/themes/default.css"></style>