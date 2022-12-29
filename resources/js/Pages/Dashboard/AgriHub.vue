<template>
    <link rel="stylesheet" href="../../css/table.css">
    <link rel="stylesheet" href="../../css/content.css">
    <link rel="stylesheet" href="../../css/sidebar.css">

    <agrihub-layout>
        <div class="container-fluid">
            <div class="d-flex justify-content-between mt-0 mb-0 mx-2">
                <div class="mb-2">
                    <p class="fs-6 mb-0 fw-bolder text-capitalize" v-text="'Dashboard'"></p> 
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 fs-8">
                            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" :href="route('Agrihub.AgriHubDashboardIndex')" >Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
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
            </div>

            <div class="row mb-3 mt-0">
                <div class="col-6 ">
                    <div class="d-flex h-100 p-3 justify-content-between bg-white rounded-8">
                        <div class="d-flex flex-column ">
                            <p class="fs-7">DEMANDS</p>

                            <div class="d-flex align-items-center gap-3 align">
                                <span class="align-bottom" style="font-size:3.5rem;">28</span>
                                <div class="d-flex flex-column">
                                    <p class="fs-8 mb-0">Receivables</p>
                                    <p class="fs-8 mb-0"> P 45,000.00 </p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column ">
                            <p class="fs-7">COMMITMENTS</p>

                            <div class="d-flex align-items-center gap-3 align">
                                <span class="align-bottom" style="font-size:3.5rem;">28</span>
                                <div class="d-flex flex-column">
                                    <p class="fs-8 mb-0">Payables</p>
                                    <p class="fs-8 mb-0"> P 45,000.00 </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="d-flex p-3 h-100 bg-white rounded-8">
                        <div class="d-flex flex-column justify-content-between">
                            <p class="fs-7">Net. Amount</p>

                            <p class="fs-3 align-bottom mb-0"> P 45,000.00 </p>
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="d-flex p-3 h-100 bg-white rounded-8">
                        <div class="d-flex flex-column justify-content-between">
                            <p class="fs-7">New Accounts</p>

                            <p class="fs-1 align-bottom mb-0"> 21,560 </p>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column">
                                    <p class="fs-8 mb-0">Trader</p>
                                    <span> 63 </span>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="fs-8 mb-0">Farmers</p>
                                    <span> 63 </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="d-flex p-3 h-100 w-100 bg-white rounded-8">
                        <div class="d-flex flex-column justify-content-between">
                            <p class="fs-7">Verified Accounts</p>

                            <p class="fs-1 align-bottom mb-0"> 21,560 </p>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column">
                                    <p class="fs-8 mb-0">Trader</p>
                                    <span> 63 </span>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="fs-8 mb-0">Farmers</p>
                                    <span> 63 </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3 ">
                <div class="col-8">
                    <div class="d-flex p-3 justify-content-between bg-white rounded-8" style="height:230px;">
                        <span class="fs-7">Price Trend</span>
                        <span class="text-main-red fs-7"> Note: Fixing Chart Plugin</span>
                    </div>
                </div>

                <div class="col-4">
                    <div class="d-flex p-3 flex-column justify-content-between bg-white rounded-8" style="height:230px;">
                        <span class="fs-7" for="">Inventory On-hand</span>

                        <div class="d-flex flex-column">
                            <span class="fs-8"> 2/3 in shelf </span>
                            <p class="fs-2 mb-0">Ampalaya</p>
                            <div class="d-flex justify-content-start fs-7">
                                <div class="flex-fill"> 1,200 kg </div>
                                <div class="flex-fill"> Class A </div>
                                <div class="flex-fill"> Variety: Sample Variety </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-4">
                    <div class="d-flex p-3 justify-content-between bg-white rounded-8" style="height:230px;">
                        <span class="fs-7">Sales</span>
                    </div>
                </div>
                <div class="col-2">
                    <div class="d-flex p-3 justify-content-between bg-white rounded-8" style="height:230px;">
                        <span class="fs-7">Sales</span>
                        <span class="text-main-red fs-7"> Note: Fixing Chart Plugin</span>
                    </div>
                </div>

                <div class="col-2">
                    <div class="d-flex flex-column p-3 justify-content-between bg-white rounded-8" style="height:230px;">
                        <div class="d-flex flex-column">
                            <p class="fs-8 mb-0">Receivables</p>
                            <p class="fs-8 mb-0"> P 45,000.00 </p>
                        </div>

                        <div class="d-flex flex-column">
                            <p class="fs-8 mb-0">Payables</p>
                            <p class="fs-8 mb-0"> P 45,000.00 </p>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="d-flex flex-column p-3 justify-content-between bg-white rounded-8" style="height:230px;">
                        <div class="fs-8 mb-0">Price Index</div>
                        <div class="fs-1 mb-0"> P 45.97 </div>
                    </div>
                </div>
            </div>
        </div>
    </agrihub-layout>
</template>

<script>
    import AgrihubLayout from '@/Layouts/AgrihubLayout.vue'
    import Modal from '@/Jetstream/Modal'
	import Swal from 'sweetalert2'
    import TablePagination from '../../Components/TablePagination.vue'
    import TableComponent from '../../Components/Table.vue'
    import { Link } from '@inertiajs/inertia-vue3'
    import Helpers from '../../Mixins/Helpers.js'

    export default {
        components: {
            AgrihubLayout,
            Modal,
            Swal,
            TableComponent,
            TablePagination,
            Link,
        },
        mixins: [Helpers],
        props: ['SupplyAndDemands', 'Accounts', 'PriceTrend', 'SalesAndTransactions', 'Inventory'],
		data() {
			return {
            }
        },
    }
</script>
