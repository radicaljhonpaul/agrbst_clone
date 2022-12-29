<template>
    <link rel="stylesheet" href="../../css/table.css">
    <link rel="stylesheet" href="../../css/content.css">

    <component :is="layout">
        <div class="container-fluid">
            <section class="d-flex justify-content-between mt-0 mb-0 mx-2">
                <div class="mb-2">
                    <p class="fs-6 mb-0 fw-bolder text-capitalize" v-text="'Supply and Demands Calendar'"></p> 
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 fs-8">
                            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" :href="route('Agrihub.AgriHubDashboardIndex')" >Dashboard</a></li>
                            <li class="breadcrumb-item" role="button" @click="this.go_back()" aria-current="page">Supply and Demands</li>
                            <li class="breadcrumb-item active" aria-current="page">Supply and Demands Calendar</li>
                        </ol>
                    </nav>
                </div>
                <div class="align-self-center">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text bg-white" id="inputGroup-sizing-sm">Search &nbsp;<i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"> Filter <i class="bi bi-eye"></i> </button>
                    </div>
                </div>
            </section>

            <section class="row bg-white mb-2 mt-0 mx-2 rounded-8 py-4">
                <!-- <inventory-and-orders-calendar :eventsData="this.Demands" :RoutePrefix="this.RoutePrefix"></inventory-and-orders-calendar> -->
            </section>
        </div>

    </component>
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
    // import InventoryAndOrdersCalendar from '../../Components/Calendar.vue

    export default {
        components: {
            AgrihubLayout,
            CaGoLayout,
            Modal,
            Swal,
            TableComponent,
            TablePagination,
            Link,
            // InventoryAndOrdersCalendar,
        },
        mixins: [Helpers],
        props: ['Demands', 'RoutePrefix'],
		data() {
            const month = new Date().getMonth();
            const year = new Date().getFullYear();
			return {
                layout: shallowRef('div'),
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