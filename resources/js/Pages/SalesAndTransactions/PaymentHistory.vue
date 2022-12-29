<style scoped>
    :focus {outline:0 !important;}
</style>
<template>
    <link rel="stylesheet" href="../../css/table.css">
    <link rel="stylesheet" href="../../css/content.css">

    <component :is="layout">
        <div class="container-fluid">
            <section class="d-flex justify-content-between mt-0 mb-0 mx-2">
                <div class="mb-2">
                    <p class="fs-6 mb-0 fw-bolder text-capitalize" v-text="'Payment History'"></p> 
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 fs-8">   
                            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" :href="route('Agrihub.AgriHubDashboardIndex')" >Dashboard</a></li>
                            <li class="breadcrumb-item" role="button" @click="this.go_back()" aria-current="page">Sales and Transactions</li>
                            <li class="breadcrumb-item active" aria-current="page"> {{ this.PaymentHistoryData[0].transaction_no }} </li>
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

            <section class="row bg-white mb-2 mt-0 mx-2 rounded-8">
                <div class="col-12 d-flex justify-content-between p-4">
                    <div class="d-flex flex-column">
                        <div>
                            <label for="" class="fs-8">Payer's Details</label>
                            <p class="fs-6 mb-0 text-capitalize"> {{ PaymentHistoryData[0].user_detail.fname +' '+ PaymentHistoryData[0].user_detail.lname }} </p>
                            <div class="fs-7 text-capitalize" v-html="this.PaymentHistoryData[0].user_detail.brgy +'., '+ this.PaymentHistoryData[0].user_detail.city +', '+ this.PaymentHistoryData[0].user_detail.province +', '+ this.PaymentHistoryData[0].user_detail.region"></div>
                            <p class="fs-7"><a href="mailto:{{ this.PaymentHistoryData[0].user_detail.user.email }}" v-html="this.PaymentHistoryData[0].user_detail.user.email"></a></p>
                        </div>

                        <div>
                            <label for="" class="fs-8">Particulars and Delivery Date</label>

                            <div class="">

                                <ul class="list-group list-group-horizontal" >
                                    <li class="list-group-item d-flex justify-content-between align-items-start p-1" v-for="demands in PaymentHistoryData[0].demands" :key="demands">
                                        <div class="mx-0">
                                            <div class="fw-bold fs-8" v-html="demands.crop.name"></div>
                                            <span class="fw-light fs-8" v-html="this.DateFormatDateOnly(demands.date)"></span>
                                        </div>
                                    </li>
                                </ul>

                                <!-- <ol class="list-group "  v-for="demands in PaymentHistoryData[0].demands" :key="demands">
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="mx-0">
                                            <div class="fw-bold fs-8" v-html="demands.crop.name"></div>
                                            <span class="fw-light fs-8" v-html="this.DateFormatDateOnly(demands.date)"></span>
                                        </div>
                                    </li>
                                </ol> -->
                                <!-- <span v-for="demands in PaymentHistoryData[0].demands" :key="demands" class="badge bg-primary pending rounded-pill text-capitalize fs-9 fw-light me-1" style="padding-top: 0.4rem;padding-bottom: 0.4rem;padding-left: 0.6rem;padding-right: 0.6rem;">
                                    {{ demands.crop.name }}
                                </span> -->
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column">
                        <div class="d-flex gap-3">
                            <div>
                                <label for="" class="fw-ligh fs-8">Transaction No.</label>
                                <p class="fs-6 text-capitalize" v-html="PaymentHistoryData[0].transaction_no"></p>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div>
                                <label for="" class="fw-ligh fs-8">Total Amount</label>
                                <p class="fs-6 fw-bold text-capitalize" v-html="this.MondeyDigitFormat(PaymentHistoryData[0].amount)"></p>
                            </div>

                            <div>
                                <label v-if="PaymentHistoryData[0].payment_history.length == 0" for="" class="fs-8">Billing Invoice</label>
                                <Link v-if="PaymentHistoryData[0].payment_history.length == 0" type="button" class="btn btn-table-aqua rounded-pill btn-sm fs-8" :href="route(this.RoutePrefix+'.Invoice')" :method="'GET'" :data="{ TrasactionData : { Amount: PaymentHistoryData[0].amount, Transaction_No : PaymentHistoryData[0].transaction_no, Created : PaymentHistoryData[0].created_at, Updated : PaymentHistoryData[0].updated_at, DeliveryDue : PaymentHistoryData[0].date, PreviousPayment : PaymentHistoryData[0].payment_history[key-1] } , InvoiceData: this.jsonStingIFY(paymentData), PayorsData : this.jsonStingIFY(PaymentHistoryData[0].user_detail), Demands : this.jsonStingIFY(PaymentHistoryData[0].demands) }" > Billing Invoice <i class="bi bi-receipt-cutoff"></i> </Link>
                            </div>
                            
                        </div>
                    </div>

                </div>

                <div class="col-12 fixTableHead" v-if="this.PaymentHistoryData[0].payment_history.length > 0">
                    <table class="">
                        <thead>
                            <tr>
                                <th scope="col" class="fs-7"> Date </th>
                                <th scope="col" class="fs-7"> Reference No. </th>
                                <th scope="col" class="fs-7"> Method </th>
                                <th scope="col" class="fs-7"> Amount </th>
                                <th scope="col" class="fs-7"> Balance </th>
                                <th scope="col" class="fs-7"> Remarks </th>
                                <th scope="col" class="fs-7"> Status </th>
                                <th scope="col" class="fs-7"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="fs-8" v-for="(paymentData, key) in PaymentHistoryData[0].payment_history" :key="key">
                                <td class="align-middle">
                                    <span class="text-wrap" v-html="this.DateFormat(paymentData.created_at)"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-wrap" v-html="paymentData.reference_no"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-wrap text-capitalize" v-html="paymentData.payment_method"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-wrap" v-html="this.MondeyDigitFormat(paymentData.amount)"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-wrap" v-html="this.MondeyDigitFormat(PaymentHistoryData[0].amount-paymentData.amount)"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-wrap text-capitalize" v-html="paymentData.remarks"></span>
                                </td>
                                <td class="align-middle">
                                    <span class="badge pending rounded-pill text-capitalize fs-9 fw-light" :class="{'text-main-yellow bg-main-yellow-118-opacity' : paymentData.status =='pending', 'text-main-green bg-main-green-118-opacity' : paymentData.status =='paid' }" style="padding-top: 0.6rem;padding-bottom: 0.6rem;padding-left: 0.8rem;padding-right: 0.8rem;">
                                        <i class="bi bi-circle-fill"></i> {{ paymentData.status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <Link type="button" class="btn btn-table-aqua rounded-pill btn-sm fs-8" :href="route(this.RoutePrefix+'.Invoice')" :method="'GET'" :data="{ TrasactionData : { Amount: PaymentHistoryData[0].amount, Transaction_No : PaymentHistoryData[0].transaction_no, Created : PaymentHistoryData[0].created_at, Updated : PaymentHistoryData[0].updated_at, DeliveryDue : PaymentHistoryData[0].date, PreviousPayment : PaymentHistoryData[0].payment_history[key-1] } , InvoiceData: this.jsonStingIFY(paymentData), PayorsData : this.jsonStingIFY(PaymentHistoryData[0].user_detail), Demands : this.jsonStingIFY(PaymentHistoryData[0].demands) }" > Invoice <i class="bi bi-receipt-cutoff"></i> </Link>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="col-12 p-4 text-center" v-else>
                    <hr>
                    <p class="fs-1 text-main-aqua mb-0">
                        <i class="bi bi-exclamation-triangle"></i> 
                    </p>
                    <p class="fs-7 text-main-aqua"> Looks like there are no payments made yet. </p>
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
        props: ['PaymentHistoryData', 'RoutePrefix'],
		data() {
			return {
                layout: shallowRef('div'),
            }
        },
        methods: {
            jsonStingIFY(data){
                return JSON.stringify(data);
            },
        },
        created: function(){
            if(this.RoutePrefix == 'CaGo'){
                this.layout = CaGoLayout;
                console.log("<ca-go-layout>");
            }else if(this.RoutePrefix == 'Agrihub'){
                this.layout = AgrihubLayout;
                console.log("<agrihub-layout>");
            }

            console.log(this.PaymentHistoryData);
        }
    }
</script>
