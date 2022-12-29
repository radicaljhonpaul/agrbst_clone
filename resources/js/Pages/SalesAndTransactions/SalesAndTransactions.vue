<style scoped>
    :focus {outline:0 !important;}
</style>
<template>
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/content.css">

    <!-- <component :is="layout"> -->
    <agrihub-layout>
        <div class="container-fluid">
            <section class="d-flex justify-content-between mt-0 mb-0 mx-2">
                <div class="mb-2">
                    <p class="fs-6 mb-0 fw-bolder text-capitalize" v-text="'Sales and Transactions'"></p> 
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 fs-8">   
                            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" :href="route('Agrihub.AgriHubDashboardIndex')" >Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sales and Transactions</li>
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

            <!-- <pre> {{ Transactions }} </pre> -->
            <section class="row bg-white mb-2 mt-0 mx-2 rounded-8">
                <div class="col-12 fixTableHead">
                    <table class="">
                        <thead>
                            <tr>
                                <th scope="col" class="fs-7"> ID No. </th>
                                <th scope="col" class="fs-7"> Transaction No. </th>
                                <th scope="col" class="fs-7"> Type </th>
                                <th scope="col" class="fs-7"> Date Ordered </th>
                                <th scope="col" class="fs-7"> Commodities </th>
                                <th scope="col" class="fs-7"> Status </th>
                                <th scope="col" class="fs-7"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="fs-8" v-for="transaction in Transactions.data" :key="transaction">
                                <td class="align-middle">
                                    <!-- <pre>
                                        {{ transaction }}
                                    </pre> -->
                                    <span class="text-wrap" v-html="transaction.id"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-wrap" v-html="transaction.transaction_no"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-wrap text-capitalize" v-html="transaction.transaction_type"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-wrap" v-html="this.DateFormatDateOnly(transaction.created_at)"></span>
                                </td>
                                <td class="align-middle text-start">
                                    <!-- <ol class="list-group"  v-for="commodities in transaction.demands" :key="commodities">
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold" v-html="commodities.crop.name"></div>
                                                <span class="fw-light" v-html="this.DateFormatDateOnly(commodities.date)"></span>
                                            </div>
                                        </li>
                                    </ol> -->
                                    
                                    <span class="badge pending rounded-pill text-capitalize fs-9 fw-bold text-main-green bg-main-green-118-opacity" style="padding-top: 0.6rem;padding-bottom: 0.6rem;padding-left: 0.8rem;padding-right: 0.8rem;">
                                        {{ transaction.demands.length }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <span class="badge pending rounded-pill text-capitalize fs-9 fw-light" :class="{'text-main-yellow bg-main-yellow-118-opacity' : transaction.status =='pending', 'text-main-green bg-main-green-118-opacity' : transaction.status =='paid' }" style="padding-top: 0.6rem;padding-bottom: 0.6rem;padding-left: 0.8rem;padding-right: 0.8rem;">
                                        <i class="bi bi-circle-fill"></i> {{ transaction.status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <Link type="button" class="btn btn-table-aqua rounded-pill btn-sm fs-8" :href="route(this.RoutePrefix+'.PaymentHistory')" :method="'GET'" :data="{ mapped_transaction_id: transaction.id }" > Receivable <i class="bi bi-list-nested"></i> </Link>
                                        <Link type="button" class="btn btn-table-default rounded-pill btn-sm fs-8" :href="route(this.RoutePrefix+'.Payables')" :method="'GET'" :data="{ demand: transaction }" > Payables <i class="bi bi-credit-card"></i> </Link>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col">
                    <table-pagination :links="Transactions.links" :current_page="Transactions.current_page" :prev_url="Transactions.prev_page_url" :next_url="Transactions.next_page_url" :total_page="Transactions.last_page" :path="Transactions.path"></table-pagination>
                </div>
            </section>
        </div>
    </agrihub-layout>
    <!-- </component> -->
</template>

<script>
    import AgrihubLayout from '@/Layouts/AgrihubLayout.vue'
    import CaGoLayout from '@/Layouts/CaGoLayout.vue'
    import Modal from '@/Jetstream/Modal'
	import Swal from 'sweetalert2'
    import TablePagination from '../../Components/TablePagination.vue'
    import { shallowRef } from "vue"; 
    import { Link } from '@inertiajs/inertia-vue3'
    import Helpers from '../../Mixins/Helpers.js'


    export default {
        components: {
            AgrihubLayout,
            CaGoLayout,
            Modal,
            Swal,
            TablePagination,
            Link,
        },
        mixins: [Helpers],
        props: ['Transactions', 'RoutePrefix'],
		data() {
			return {
                layout: shallowRef('div'),
            }
        },
        methods: {
            sTringify(data){
                return JSON.stringify(data);
            },
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
            console.log("Transactions");
            console.log(this.Transactions);
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
