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
                    <p class="fs-6 mb-0 fw-bolder text-capitalize">
                        <span class="" v-text="'TRANSACTION No. '"></span> <span v-text="this.ConsolidatedDemandDetails[0].pool_no"></span>
                    </p> 
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 fs-8">
                            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" :href="route('Agrihub.AgriHubDashboardIndex')" >Dashboard</a></li>
                            <li class="breadcrumb-item" role="button" @click="this.go_back()" aria-current="page">Supply and Demands</li>
                            <li class="breadcrumb-item active" aria-current="page" v-text="'Consolidated Demands: ' + this.ConsolidatedDemandDetails[0].pool_no"> </li>
                        </ol>
                    </nav>
                </div>
            </section>
            <section class="row bg-white mb-2 mt-0 mx-2 p-4 rounded-8">
                <div class="col-12 d-flex justify-content-between text-wrap text-break text-main-dark-grey">
                    <div class="align-self-start me-3">
                        <label for="" class="fs-8 fw-bold">Commodity</label>
                        <p class="fs-6 mb-0" v-html="this.ConsolidatedDemandDetails[0].crop.name"></p>
                        <p class="text-main-green fs-8" v-html="this.MondeyDigitFormat(this.ConsolidatedDemandDetails[0].crop_pricing.smp)">  </p>
                    </div>

                    <div class="align-self-start me-3">
                        <label for="" class="fs-8 fw-bold">Quantity</label>
                        <p class="fs-6" v-html="this.ConsolidatedDemandDetails[0].consolidated_qty + ' kg' "></p>
                    </div>

                    <div class="align-self-start me-3">
                        <label for="" class="fs-8 fw-bold">Amount</label>
                        <p class="fs-6" v-html="this.MondeyDigitFormat(this.ConsolidatedDemandDetails[0].consolidated_amount)"></p>
                    </div>

                    <div class="align-self-start me-3">
                        <label for="" class="fs-8 fw-bold">Delivery Date</label>
                        <p class="fs-7" v-html="this.DateFormat(this.ConsolidatedDemandDetails[0].date)"></p>
                    </div>

                    <div class="align-self-start me-3 text-center">
                        <label for="" class="fs-8 fw-bold">Status</label>
                        <br>
                        <span class="badge pending rounded-pill text-capitalize fs-9 fw-light" :class="{'text-main-aqua bg-main-aqua-118-opacity' : this.ConsolidatedDemandDetails[0].status =='pooling', 'text-main-yellow bg-main-yellow-118-opacity' : this.ConsolidatedDemandDetails[0].status =='processing', 'text-main-light-green bg-main-light-green-118-opacity' : this.ConsolidatedDemandDetails[0].status =='on-delivery', 'text-main-green bg-main-green-118-opacity' : this.ConsolidatedDemandDetails[0].status =='completed' }" style="padding-top: 0.6rem;padding-bottom: 0.6rem;padding-left: 0.8rem;padding-right: 0.8rem;">
                            <i class="bi bi-circle-fill"></i> {{ this.ConsolidatedDemandDetails[0].status }}
                        </span>
                    </div>

                </div>
                <hr>
                <p class="fs-5 fw-bold"> Demands </p>
                <div class="col-12">
                    <table class="">
                        <thead>
                            <tr>
                                <th scope="col" class="fs-7 ps-0"> Demand ID. </th>
                                <th scope="col" class="fs-7 ps-0"> Name </th>
                                <th scope="col" class="fs-7 ps-0"> Qty</th>
                                <th scope="col" class="fs-7 ps-0"> Remaining Qty </th>
                                <th scope="col" class="fs-7 ps-0"> Status </th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="fs-8"  v-for="data in DemandsWithCommits" :key="data">
                                <td class="align-middle ps-0" :class="{ 'opacity-50' : data.remaining_qty == 0 }">
                                    <span class="text-wrap" v-html="data.id"></span>
                                </td>
                                <td class="align-middle ps-0" :class="{ 'opacity-50' : data.remaining_qty == 0 }">
                                    <span class="text-wrap text-capitalize" v-html="data.trader.fname +' '+ data.trader.lname"></span>
                                </td>
                                <td class="align-middle ps-0" :class="{ 'opacity-50' : data.remaining_qty == 0 }">
                                    <span class="text-wrap" v-html="data.qty + ' kg'"></span>
                                </td>
                                <td class="align-middle ps-0" :class="{ 'opacity-50' : data.remaining_qty == 0 }">
                                    <span class="text-wrap" v-if="data.remaining_qty != null" v-html="data.remaining_qty  + ' kg'"></span>
                                    <span class="text-wrap" v-else> N/A </span>
                                </td>
                                <td class="align-middle ps-0 text-capitalize">
                                    <!-- Status => on-going, closed, on-delivery, delivered, picked-up -->
                                    <span class="badge pending rounded-pill text-capitalize fs-9 fw-light" :class="{'text-main-aqua bg-main-aqua-118-opacity' : data.status =='on-going', 'text-main-yellow bg-main-yellow-118-opacity' : data.status =='closed', 'text-main-light-green bg-main-light-green-118-opacity' : data.status =='on-delivery', 'text-main-green bg-main-green-118-opacity' : data.status =='completed' }" style="padding-top: 0.6rem;padding-bottom: 0.6rem;padding-left: 0.8rem;padding-right: 0.8rem;">
                                        <i class="bi bi-circle-fill"></i> {{ data.status }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <p class="fs-5 fw-bold"> Commits </p>
                <div class="col-12" v-if="this.Commits == null || this.Commits.length == 0">
                    <p class="fs-6 text-main-red"> No commitments found as of the moment. </p>
                </div>
                <div class="col-12" v-else>
                    <table class="" >
                        <thead>
                            <tr>
                                <th scope="col" class="fs-7 ps-0"> Committed To. </th>
                                <th scope="col" class="fs-7 ps-0"> Name </th>
                                <th scope="col" class="fs-7 ps-0" > Committed Qty</th>
                                <th scope="col" class="fs-7 ps-0"> Approved Qty </th>
                                <th scope="col" class="fs-7 ps-0"> Excess Qty </th>
                                <th scope="col" class="fs-7 ps-0"> Status </th>
                                <th scope="col" class="fs-7 ps-0"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="fs-8" v-for="commitments in Commits" :key="commitments">
                                <td class="align-middle ps-0">
                                    <!-- <span class="text-wrap text-break" v-html="commitments.demand_id"></span> -->
                                    <span v-if="commitments.commit_demand_transactions.length != 0" >
                                            <span  v-for="cdt in commitments.commit_demand_transactions" :key="cdt" class="badge pending rounded-pill text-main-aqua bg-main-aqua-118-opacity text-capitalize fs-9 me-1 fw-light" >
                                                <i class="bi bi-circle-fill fs-9"></i> {{ cdt.demand_id }}
                                            </span>
                                    </span>
                                    <span v-else class="text-wrap text-break"> N/A </span>
                                </td>
                                <td class="align-middle ps-0">
                                    <span class="text-wrap text-capitalize" v-html="commitments.farmer.fname +' '+ commitments.farmer.lname"></span>
                                </td>
                                <td class="align-middle ps-0">
                                    <span class="text-wrap" v-html="commitments.qty + ' kg'"></span>
                                    <br>
                                    <span class="text-capitalize fs-9 fw-light" :class="{'text-main-aqua' : commitments.status =='pending', 'text-main-light-green' : commitments.status =='on-delivery', 'text-main-red' : commitments.status =='disapproved', 'text-main-green' : commitments.status =='approved' }" style="padding-top: 0.6rem;padding-bottom: 0.6rem;padding-right: 0.8rem;">
                                        <i class="bi bi-circle-fill"></i> {{ commitments.status }}
                                    </span>
                                </td>
                                <td class="align-middle ps-0">
                                    <span v-if="commitments.commit_demand_transactions.length > 0">
                                        {{ this.returnApprovedQty(commitments.commit_demand_transactions) + ' kg' }}
                                    </span>
                                    <span v-else> N/A </span>
                                </td>

                                <td class="align-middle ps-0">
                                    <span class="text-wrap" v-html="commitments.excess_qty + ' kg'    "></span>
                                </td>

                                <td class="align-middle ps-0 text-capitalize">
                                    <!-- Statu => on-going, on-delivery, delivered, picked-up -->
                                    <span class="badge pending rounded-pill text-capitalize fs-9 fw-light" :class="{'text-main-yellow bg-main-yellow-118-opacity' : commitments.status =='pending', 'text-main-light-red bg-main-light-red-118-opacity' : commitments.status =='disapproved', 'text-main-green bg-main-green-118-opacity' : commitments.status =='approved' }" style="padding-top: 0.6rem;padding-bottom: 0.6rem;padding-left: 0.8rem;padding-right: 0.8rem;">
                                        <i class="bi bi-circle-fill"></i> {{ commitments.status }}
                                    </span>
                                </td>

                                <td class="align-middle ps-0 text-capitalize">
                                    <button class="btn btn-table-default ms-1 rounded-pill btn-sm fs-8" :class="{'bg-secondary text-light border-secondary' :commitments.status  == 'approved', 'bg-secondary text-light border-secondary' :commitments.status  == 'disapproved'}" :disabled="commitments.status  == 'approved' || commitments.status  == 'disapproved'" @click="approveCommit(commitments.id, commitments.demand_id, commitments.farmer.fname +' '+ commitments.farmer.lname)"> Approve? </button>
                                    <button class="btn btn-table-danger ms-1 rounded-pill btn-sm fs-8" :class="{'bg-secondary text-light border-secondary' :commitments.status  == 'approved', 'bg-secondary text-light border-secondary' :commitments.status  == 'disapproved'}" :disabled="commitments.status  == 'approved' || commitments.status  == 'disapproved'" @click="disApproveCommit(commitments.id, commitments.farmer.fname +' '+ commitments.farmer.lname)"> Disapprove? </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
        props: ['DemandsWithCommits', 'Commits', 'ConsolidatedDemandDetails' ,'RoutePrefix'],
		data() {
			return {
                layout: shallowRef('div'),
            }
        },
        methods: {
            returnCommitsArray(){
                var demandArr = [];
                this.DemandsWithCommits.forEach(element => {
                    demandArr.push(element.id);
                });
                return demandArr
            },
            returnApprovedQty(commitDemandTransactions){
                var approvedQty = 0;
                commitDemandTransactions.forEach(element => {
                    approvedQty = approvedQty+element.approved_qty;
                });
                return approvedQty
            },
            approveCommit(commitID, demandID, farmerName){

                Swal.fire({
                    title: 'Are you sure?',
                    html: '<p class="fs-5 text-capitalize"> <span class="fw-bold"> You are about to approve this commit. </span> </p>' +
                    
                    '<p class="fs-7 fst-italic mb-0"> (Note: After you confirm, An automated message will sent to our farmer <span class="text-capitalize fw-bold">'+ farmerName + '</span> via sms.) </p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#339933',
                    cancelButtonColor: '#da2d2d',
                    confirmButtonText: 'Yes, I confirm!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        // Approved
                        axios.post(route(this.RoutePrefix+'.ApproveCommit'), { commitID: commitID, demandID: demandID, demands_array : this.returnCommitsArray() })
                        .then((response)=>{
                            console.log(response.data);
                            if(response.data == 1){
                                Swal.fire({
                                    title: 'Success!',
                                    html: '<p class="fs-5 text-capitalize mb-0">  A commit by farmer <span class="fw-bold">'+ farmerName +' </span> has been Approved! </p>',
                                    icon: 'success',
                                    timer: 5000,
                                    timerProgressBar: true,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                }).then(function(){
                                    location.reload();
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Oppps!',
                                text: 'Something went wrong. Please check your network and try again.',
                                icon: 'error',
                                timer: 5000,
                                timerProgressBar: true,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                        });

                    }else{
                        // Cancel
                        
                    }
                });
            },
            disApproveCommit(commitID, farmerName){
                Swal.fire({
                    title: 'Are you sure?',
                    html: '<p class="fs-5 text-capitalize"> <span class="fw-bold"> You are about to disapprove this commit. </span> </p>' +
                    
                    '<p class="fs-7 fst-italic mb-0"> (Note: After you confirm, An automated message will sent to our farmer <span class="text-capitalize fw-bold">'+ farmerName + '</span> via sms.) </p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#339933',
                    cancelButtonColor: '#da2d2d',
                    confirmButtonText: 'Yes, I confirm!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        // Approved
                        axios.post(route(this.RoutePrefix+'.DisApproveCommit'), { commitID: commitID })
                        .then((response)=>{
                            console.log(response.data);
                            if(response.data == 1){
                                Swal.fire({
                                    title: 'Success!',
                                    html: '<p class="fs-5 text-capitalize mb-0">  A commit by farmer <span class="fw-bold">'+ farmerName +' </span> has been Disapproved! </p>',
                                    icon: 'success',
                                    timer: 5000,
                                    timerProgressBar: true,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                }).then(function(){
                                    location.reload();
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Oppps!',
                                text: 'Something went wrong. Please check your network and try again.',
                                icon: 'error',
                                timer: 5000,
                                timerProgressBar: true,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                        });

                    }else{
                        // Cancel
                        
                    }
                });
            }

        },
        created: function(){
			console.log("this.DemandsWithCommits");
			console.log(this.DemandsWithCommits);
			console.log("this.Commits");
			console.log(this.Commits);

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
