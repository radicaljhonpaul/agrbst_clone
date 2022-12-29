<style scoped>
    :focus {outline:0 !important;}
</style>
<template>
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/content.css">

    <component :is="layout">
        <div class="container-fluid">
            <section class="d-flex justify-content-between mt-0 mb-0 mx-2">
                <div class="mb-2">
                    <p class="fs-6 mb-0 fw-bolder text-capitalize" v-text="'Supply and Demands'"></p> 
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 fs-8">
                            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" :href="route('Agrihub.AgriHubDashboardIndex')" >Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Supply and Demands</li>
                        </ol>
                    </nav>
                </div>
                <div class="align-self-center">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text bg-white fs-8" id="inputGroup-sizing-sm">Search &nbsp;<i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        <button class="btn btn-outline-secondary fs-8" type="button" id="button-addon2"> Filter <i class="bi bi-eye"></i> </button>
                        <Link type="button" class="btn btn-outline-secondary fs-8" :href="route(this.RoutePrefix+'.SupplyAndDemandCalendar')" :method="'GET'" :data="{ month: this.getCurrentMonthNumber() }" > Calendar <i class="bi bi-calendar-event"></i> </Link>
                    </div>
                </div>
            </section>

            <section class="row bg-white mb-2 mt-0 mx-2 rounded-8">
                <div class="col-12 fixTableHead">
                    <table class="">
                        <thead>
                            <tr>
                                <th scope="col" class="fs-7"> ID No. </th>
                                <th scope="col" class="fs-7"> Transaction No. </th>
                                <th scope="col" class="fs-7"> Date Ordered </th>
                                <th scope="col" class="fs-7"> Delivery Date </th>
                                <th scope="col" class="fs-7"> Commodity </th>
                                <th scope="col" class="fs-7"> Accum. Qty. </th>
                                <th scope="col" class="fs-7"> Demand : Commits </th>
                                <th scope="col" class="fs-7"> Status </th>
                                <th scope="col" class="fs-7"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="fs-8" v-for="data in ConsolidatedDemands.data" :key="data">
                                <td class="align-middle">
                                    <span class="text-wrap" v-html="data.id"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-wrap" v-html="data.pool_no"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-wrap" v-html="this.DateFormat(data.created_at)"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-wrap" v-html="this.DateFormat(data.date)"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-wrap" v-html="data.crop.name"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-wrap" v-html="data.consolidated_qty + ' kg'"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-wrap" v-html="data.demands_count +' : '+ this.getRatio(data.demands)"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="badge pending rounded-pill text-capitalize fs-9 fw-light" :class="{'text-main-aqua bg-main-aqua-118-opacity' : data.status =='pooling', 'text-main-yellow bg-main-yellow-118-opacity' : data.status =='processing', 'text-main-light-green bg-main-light-green-118-opacity' : data.status =='on-delivery', 'text-main-green bg-main-green-118-opacity' : data.status =='completed' }" style="padding-top: 0.6rem;padding-bottom: 0.6rem;padding-left: 0.8rem;padding-right: 0.8rem;">
                                        <i class="bi bi-circle-fill"></i> {{ data.status }}
                                    </span>
                                </td>
                                <td>
                                    <Link type="button" class="btn btn-table-default rounded-pill btn-sm" :href="route(this.RoutePrefix+'.SpecificSupplyAndDemands')" :method="'GET'" :data="{ consolidated_id: data.id }" > View <i class="bi bi-eye"></i> </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col">
                    <table-pagination :links="ConsolidatedDemands.links" :current_page="ConsolidatedDemands.current_page" :prev_url="ConsolidatedDemands.prev_page_url" :next_url="ConsolidatedDemands.next_page_url" :total_page="ConsolidatedDemands.last_page" :path="ConsolidatedDemands.path"></table-pagination>
                </div>
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


    export default {
        components: {
            AgrihubLayout,
            CaGoLayout,
            Modal,
            Swal,
            TableComponent,
            TablePagination,
            Link,
        },
        mixins: [Helpers],
        props: ['ConsolidatedDemands', 'RoutePrefix'],
		data() {
			return {
                layout: shallowRef('div'),
            }
        },
        methods: {
            getRatio(data){
                var commitCount = 0;
                data.forEach(element => {
                    console.log(element.commit_demand_transactions_count);
                    commitCount = commitCount + element.commit_demand_transactions_count;
                });

                return commitCount;
            },
        },
        created: function(){
            console.log("getCurrentMonthNumber");
            console.log(this.getCurrentMonthNumber());
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
