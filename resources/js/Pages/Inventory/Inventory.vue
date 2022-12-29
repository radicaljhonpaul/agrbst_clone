<style scoped>
    .label1 {
        overflow: hidden;
        width: 100%;
        /* font-size: 14px; */
        font-weight: 400;
        line-height: 1.3;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    .date {
        color: #8497b0;
        font-size: 12px;
        font-weight: 400;
    }
    .score-value {
        position: relative;
        width: 65px;
        margin: 0 auto;
        font-size: 16px;
        text-align: right;
    }
    .score-value::after {
        content: '';
        position: absolute;
        top: 50%;
        right: -16px;
        display: block;
        width: 8px;
        height: 8px;
        margin-top: -4px;
        border-radius: 50%;
    }
    .score-value--very-bad::after {
        background: #f63;
    }
    .score-value--bad::after {
        background: #ffb433;
    }
    .score-value--normal::after {
        background: #ffe133;
    }
    .score-value--good::after {
        background: #8ae55c;
    }
    .score-value--very-good::after {
        background: #47b247;
    }
    .wrapper {
        border: 1px solid #e6eaf0;
    }
    table {
        border-collapse: collapse;
    }
    .table-scores {
        table-layout: fixed;
        width: 180px;
        display: inline-block;
        background: #f9fafc;
        border-right: 1px solid #e6eaf0;
        vertical-align: top;
    }
    .table-scores td, .table-scores th {
        max-width: 179px;
    }
    .table-scores th {
        background: #eff1f4;
        text-align: left;
    }

    .table-data-wrapper {
        display: inline-block;
        overflow-x: scroll;
        vertical-align: top;
        width: calc(100% - 180px);
    }
    .table-data-wrapper table {
        border-left: 0;
    }
    .table-data-wrapper td, .table-data-wrapper th {
        width: calc((100vw - 2 * 40px - 180px) / 5);
    }
    @media (min-width: 900px) {
        .table-data-wrapper td, .table-data-wrapper th {
            min-width: calc((100vw - 2 * 40px - 180px) / 5);
            max-width: calc((100vw - 2 * 40px - 180px) / 5);
        }
    }
    @media (max-width: 1023px) {
        .table-data-wrapper td, .table-data-wrapper th {
            min-width: calc((100vw - 2 * 40px - 180px) / 3);
            max-width: calc((100vw - 2 * 40px - 180px) / 3);
        }
    }
    .table-data-wrapper td:not(:last-child), .table-data-wrapper th:not(:last-child) {
        border-right: 1px solid #e6eaf0;
    }
    th {
        height: 72px;
    }
    th, td {
        padding: 0 16px;
    }
    thead {
        background: #f9fafc;
    }
    td {
        height: 48px;
    }
    thead tr, tbody tr:not(:last-child) {
        border-bottom: 1px solid #e6eaf0;
    }
    
    ::-webkit-scrollbar {
        height: 3px;
    }
    ::-webkit-scrollbar-thumb {
        background: var(--main-grey); 
        border-radius: 10px;
    }

</style>
<template>

    <component :is="layout">
        <div class="container-fluid">
            <section class="d-flex justify-content-between mt-0 mb-0 mx-2">
                <div class="mb-2">
                    <p class="fs-6 mb-0 fw-bolder text-capitalize" v-text="'Inventory & Orders'"></p> 
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 fs-8">   
                            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" :href="route('Agrihub.AgriHubDashboardIndex')" >Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Inventory & Orders</li>
                        </ol>
                    </nav>
                </div>
                <div class="align-self-center">
                    <div class="input-group input-group-sm mb-3">
                        <!-- <span class="input-group-text bg-white" id="inputGroup-sizing-sm">Search &nbsp;<i class="bi bi-search"></i></span> -->
                        <!-- <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"> -->
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"> Filter <i class="bi bi-eye"></i> </button>
                    </div>
                </div>
            </section>

            <section class="row bg-white mb-2 mt-0 mx-2 rounded-8 py-4">
                <inventory-and-orders-calendar @updateEventData="Demands = $event" :eventsData="Demands" :RoutePrefix="this.RoutePrefix"></inventory-and-orders-calendar>
            </section>

            <!-- <section class="row bg-white mb-2 mt-0 mx-2 rounded-8 py-4">
                <div class="col-8 d-flex flex-fill justify-content-between">
                    <div class="text-wrap">
                        <label for="" class="fs-8">Commodity</label>
                        <p class="fw-bold mb-0 fs-4"> Squash </p>
                        <p class="fs-8 mb-0 text-wrap text-break">
                            This here is some placeholder text, intended to take up quite a bit of vertical space, to demonstrate how the vertical alignment works in the preceding cells.
                        </p>
                    </div>
                    <div class="text-wrap flex-fill w-100">
                        <label for="" class="fs-8">Class</label>
                        <p class="fw-bold"> Class 1 </p>
                    </div>
                    <div class="text-wrap flex-fill w-100">
                        <label for="" class="fs-8">Variety</label>
                        <p class="fw-bold"> Class 1 </p>
                    </div>
                </div>

                <div class="col-4 d-flex justify-content-start">
                    <div>
                        <label for="" class="fs-8">Period</label>
                        <p class="fw-bold"> Start Date </p>
                        <p class="fw-bold"> End Date </p>
                    </div>
                </div>

                <hr>

                <div class="table-responsive"> 
                    <table class="table-scores">
                        <thead>
                            <tr>
                                <th>
                                    <div class="label1 fs-7"></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="label1 fs-7"> Demands </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="label1 fs-7"> Supply </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="label1 fs-7">FGP (Farmgate Price)</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="label1 fs-7">SMP (Social Market Price)</div>	
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="label1 fs-7">Surplus</div>	
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="label1 fs-7">Committed</div>	
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="label1 fs-7">On-hand</div>	
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="table-data-wrapper">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="label1">13. Neuro-QOL: Upper Extremity Function (Fine Motor, ADL)</div>
                                        <div class="date">09/05/2017, 06:42 AM PDT</div>
                                    </th>
                                    <th>
                                        <div class="label1">09. Neuro-QOL: Anxiety</div>
                                        <div class="date">09/01/2017, 07:34 AM PDT</div>
                                    </th>
                                    <th>
                                        <div class="label1">SpinePostOpBack_WallaWalla_V4</div>
                                        <div class="date">09/01/2017, 05:24 AM PDT</div>
                                    </th>
                                    <th>
                                        <div class="label1">BrainTumorFACTBr</div>
                                        <div class="date">08/10/2017, 11:59 AM PDT</div>
                                    </th>
                                    <th>
                                        <div class="label1">SpinePreOp_V4_</div>
                                        <div class="date">08/10/2017, 10:54 AM PDT</div>
                                    </th>
                                    <th>
                                        <div class="label1">Post-Op HOOS Survey</div>
                                        <div class="date">07/26/2017, 07:32 AM PDT</div>
                                    </th>
                                    <th>
                                        <div class="label1">Post-Op KOOS Survey</div>
                                        <div class="date">01/25/2017, 11:22 PM PST</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="score-value score-value--very-bad">45</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--bad">45.3</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--normal">-45</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--very-bad">45.345</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--very-good">-245.45</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--good">-45.221</div>
                                    </td>
                                    <td>
                                        <div class="score-value">-</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="score-value score-value--bad">45.3</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--good">-45.221</div>
                                    </td>
                                    <td>
                                        <div class="score-value">-</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--very-good">-45</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--normal">45.345</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--bad">45</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--very-good">-245.45</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="score-value score-value--very-bad">-45</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--very-bad">45.345</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--good">45</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--very-bad">45.3</div>
                                    </td>
                                    <td>
                                        <div class="score-value">-</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--very-bad">-245.45</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--normal">-45.221</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="score-value score-value--very-bad">-45</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--very-bad">45.345</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--good">45</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--very-bad">45.3</div>
                                    </td>
                                    <td>
                                        <div class="score-value">-</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--very-bad">-245.45</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--normal">-45.221</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="score-value score-value--very-bad">-45</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--very-bad">45.345</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--good">45</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--very-bad">45.3</div>
                                    </td>
                                    <td>
                                        <div class="score-value">-</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--very-bad">-245.45</div>
                                    </td>
                                    <td>
                                        <div class="score-value score-value--normal">-45.221</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section> -->
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
    import InventoryAndOrdersCalendar from '../../Components/Calendar.vue'

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
            sample(data){
                console.log("sample data");
                console.log(data);
                this.Demands = data;
            }
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