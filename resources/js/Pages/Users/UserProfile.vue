<style scoped>
    :focus {outline:0 !important;}

    .breadcrumb-item{
        cursor: pointer !important;
    }
</style>
<template>
    <link rel="stylesheet" href="../css/content.css">

    <component :is="layout">
        <div class="container-fluid" style="z-index: 0;">
            <div class="row mb-3 display-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1 fs-8">
                        <li class="breadcrumb-item"><a :href="route(this.RoutePrefix+'.AgriHubDashboardIndex')" >Dashboard</a></li>
                        <li class="breadcrumb-item " aria-current="page" @click="this.go_back()">Farmer Accounts</li>
                        <li class="breadcrumb-item active text-capitalize" aria-current="page"> {{ this.AccountType }} </li>
                    </ol>
                </nav>
                
                <div class="col-8">
                    <div class="d-flex justify-content-start rounded-8 section-hoverable" :class="{ 'profile-card-trader' : this.AccountType == 'trader' , 'profile-card-farmer' : this.AccountType == 'farmer' }">
                        <div class="py-4 ps-4 pe-3 align-self-start">
                            <img src="/images/Profile.jpg" class="rounded-circle bg-white border border-light border-4" style="width:90px;height:90px;object-fit: contain;" alt="">

                            <div class="px-2 mx-0 text-left">
                                <span :class="{ 'mb-2 fs-8 text-main-green text-capitalize fw-light' : this.UserAccountInfo[0].status == 'approved', 'mb-2 fs-8 text-main-yellow text-capitalize fw-light' : this.UserAccountInfo[0].status == 'pending' }" >
                                    <i class="bi bi-circle-fill"></i> {{ this.UserAccountInfo[0].status }}
                                </span>
                                
                                <p v-if="this.UserAccountInfo[0].status == 'pending'" class="text-secondary fs-7" data-bs-toggle="modal" data-bs-target="#ApproveConfirmationModal" style="cursor:pointer;"> Approve? <i class="bi bi-check-circle"></i> </p>
                            </div>
                        </div>

                        <div class="pt-4 pb-2 px-1 text-white text-start">
                            <p class="fs-3 fw-bold mb-2 text-capitalize">
                                {{ this.UserAccountInfo[0].user_detail.fname +' '+  this.UserAccountInfo[0].user_detail.lname }}
                            </p>
                            <p v-if="this.AccountType == 'trader'" class="text-main-dark-grey fw-bolder fs-5 text-capitalize">
                                {{ this.UserAccountInfo[0].user_detail.business_detail.business_name }}
                            </p>
                            <p v-if="this.AccountType == 'farmer'" class="text-main-dark-grey fw-bolder fs-5 text-capitalize mb-0">
                                {{ this.UserAccountInfo[0].user_detail.farm_detail.farm_name }}
                            </p>

                            <div class="d-flex text-wrap text-break text-main-dark-grey">
                                <div class="pe-4 w-100">
                                    <p class="fs-6 text-main-grey">
                                        <i class="bi bi-phone"></i> {{ this.UserAccountInfo[0].user_detail.phone }}
                                    </p>

                                    <span v-if="this.AccountType == 'trader'" class="fw-bold fs-7 mb-0" > 
                                        <p class="fw-bold fs-7 mb-0">Business Address <i class="bi bi-geo-alt"></i></p>
                                        <p class="mb-0 text-capitalize">
                                            {{ 'Brgy '+ this.UserAccountInfo[0].user_detail.business_detail.brgy +', '+ this.UserAccountInfo[0].user_detail.business_detail.city +', '+ this.UserAccountInfo[0].user_detail.business_detail.province +', '+ this.UserAccountInfo[0].user_detail.business_detail.region}}
                                        </p>
                                        <p> {{ this.UserAccountInfo[0].user_detail.business_detail.long +','+ this.UserAccountInfo[0].user_detail.business_detail.lat }} </p>
                                    </span>

                                    <span v-else class=""> 
                                        <p class="fw-bold fs-7 mb-0">Farm Address <i class="bi bi-geo-alt"></i></p>
                                        <span :class="{ 'fs-7' : this.AccountType == 'trader', 'fs-8' : this.AccountType == 'farmer' }">
                                            <p class=" mb-0 text-capitalize">
                                                {{ 'Brgy '+ this.UserAccountInfo[0].user_detail.farm_detail.brgy +', '+ this.UserAccountInfo[0].user_detail.farm_detail.city +', '+ this.UserAccountInfo[0].user_detail.farm_detail.province +', '+ this.UserAccountInfo[0].user_detail.farm_detail.region}}
                                            </p>
                                            <p> {{ this.UserAccountInfo[0].user_detail.farm_detail.long +','+ this.UserAccountInfo[0].user_detail.farm_detail.lat }} </p>
                                        </span>
                                        
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <label class="mt-0 fs-8 fw-bold">RFS</label>
                                                <p class="text-wrap text-break mb-0">
                                                    <span class="fs-7">
                                                        {{ this.MondeyDigitFormat(this.UserAccountInfo[0].user_detail.farm_detail.farm_size) }}
                                                    </span>
                                                    <span class="fs-8 fst-italic">sqm </span>
                                                </p>
                                            </div>

                                            <div>
                                                <label class="mt-0 fs-8 fw-bold">CMF</label>
                                                <p class="text-wrap text-break mb-0">
                                                    <span class="fs-7">
                                                        {{ this.MondeyDigitFormat(this.UserAccountInfo[0].user_detail.farm_detail.farm_size) }}
                                                    </span>
                                                    <span class="fs-8 fst-italic">sqm </span>
                                                </p>
                                            </div>

                                            <div>
                                                <label class="mt-0 fs-8 fw-bold">AFS</label>
                                                <p class="text-wrap text-break mb-0">
                                                    <span class="fs-7">
                                                        {{ this.MondeyDigitFormat(this.UserAccountInfo[0].user_detail.farm_detail.farm_size) }}
                                                    </span>
                                                    <span class="fs-8 fst-italic">sqm </span>
                                                </p>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                                <div class="pe-4 w-100">
                                    <p class="fs-6 text-main-grey">
                                        <i class="bi bi-envelope"></i> {{ this.UserAccountInfo[0].email }}
                                    </p>

                                    <p class="fw-bold fs-7 mb-0"> Personal Address <i class="bi bi-geo-alt"></i></p>
                                    <span :class="{ 'fs-7' : this.AccountType == 'trader', 'fs-8' : this.AccountType == 'farmer' }">
                                        <p class=" mb-0 text-capitalize">
                                            {{ 'Brgy '+ this.UserAccountInfo[0].user_detail.brgy +', '+ this.UserAccountInfo[0].user_detail.city +', '+ this.UserAccountInfo[0].user_detail.province +', '+ this.UserAccountInfo[0].user_detail.region}}
                                        </p>
                                        <p> {{ this.UserAccountInfo[0].user_detail.long +','+ this.UserAccountInfo[0].user_detail.lat }} </p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-4" v-if="this.AccountType == 'farmer'">
                    <div class="d-flex align-items-stretch flex-wrap justify-content-start h-100">
                        <accumulated-amount-farmer></accumulated-amount-farmer>
                    </div>
                </div>

                <div class="col-4" v-else>
                    <div class="d-flex align-items-stretch flex-wrap justify-content-start h-100">
                        <accumulated-amount-trader></accumulated-amount-trader>
                    </div>
                </div>
            </div>
            
            <div class="row mb-3 display-flex">
                <!-- if farmer transaction -->
                <div class="col-8" v-if="this.AccountType == 'farmer'">
                    <featured-transaction></featured-transaction>
                </div>
                <!-- if farmer transaction -->
                <div class="col-8" v-else>
                    <featured-transaction :userID="this.UserAccountInfo[0].id"></featured-transaction>
                </div>
                <div class="col-4">
                    <div class="d-flex flex-column pending-accounts justify-content-start rounded-8 section-hoverable ps-4 pt-3 pe-4" style="height:250px;">
                        <div class="d-flex justify-content-between">
                            <p class="fw-bold fs-7 mb-0"> Recent Activity <i class="bi bi-window-stack"></i> </p>
                            <a href="#" class="text-decoration-none text-main-green"> <i class="bi bi-box-arrow-up-right fw-bold fs-7"></i> </a>
                        </div>

                        <div class="flex-fill mt-2 fs-7" style="overflow-y: scroll;">
                            <div class="">
                                <ul class="list-group">
                                    <li class="list-group-item ps-0 pe-0 border-0 d-flex justify-content-between align-items-center">
                                        <div class="ms-0 me-auto">
                                            <div class="fw-normal">{{ "Commit to Demand"}}</div>
                                            <span class="fs-8 fst-italic">
                                                {{ "Wed ,Jun 15 2022 11:38:44 pm" }}
                                            </span>
                                        </div>
                                        <i class="bi bi-file-earmark-medical mx-2"></i>
                                    </li>
                                    <li class="list-group-item ps-0 pe-0 border-0 d-flex justify-content-between align-items-center">
                                        <div class="ms-0 me-auto">
                                            <div class="fw-normal">{{ "Commit to Agrihub"}}</div>
                                            <span class="fs-8 fst-italic">
                                                {{ "Wed ,Jun 15 2022 11:38:44 pm" }}
                                            </span>
                                        </div>
                                        <i class="bi bi-file-earmark-medical mx-2"></i>
                                    </li>
                                    <li class="list-group-item ps-0 pe-0 border-0 d-flex justify-content-between align-items-center">
                                        <div class="ms-0 me-auto">
                                            <div class="fw-normal">{{ "Response to Agrihub Request"}}</div>
                                            <span class="fs-8 fst-italic">
                                                {{ "Wed ,Jun 15 2022 11:38:44 pm" }}
                                            </span>
                                        </div>
                                        <i class="bi bi-reply mx-2"></i>
                                    </li>
                                    <li class="list-group-item ps-0 pe-0 border-0 d-flex justify-content-between align-items-center">
                                        <div class="ms-0 me-auto">
                                            <div class="fw-normal">{{ "Deposit Delivery"}}</div>
                                            <span class="fs-8 fst-italic">
                                                {{ "Wed ,Jun 15 2022 11:38:44 pm" }}
                                            </span>
                                        </div>
                                        <i class="bi bi-save mx-2"></i>
                                    </li>
                                    <li class="list-group-item ps-0 pe-0 border-0 d-flex justify-content-between align-items-center">
                                        <div class="ms-0 me-auto">
                                            <div class="fw-normal">{{ "Deposit Delivery"}}</div>
                                            <span class="fs-8 fst-italic">
                                                {{ "Wed ,Jun 15 2022 11:38:44 pm" }}
                                            </span>
                                        </div>
                                        <i class="bi bi-save mx-2"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3 display-flex">
                <div class="col-8" v-if="this.AccountType == 'farmer'">
                    <harvest-component></harvest-component>
                </div>

                <div class="col-8" v-else>
                    <order-component></order-component>
                </div>

                <div class="col-4">
                    <div class="d-flex flex-column pending-accounts justify-content-start rounded-8 section-hoverable ps-4 pt-3 pe-4" style="height:300px;">
                        <div class="d-flex justify-content-between">
                            <p class="fw-bold fs-7 mb-0"> Recent Files <i class="bi bi-file-earmark-medical"></i> </p>
                            <a href="#" class="text-decoration-none text-main-green"> <i class="bi bi-box-arrow-up-right fw-bold fs-7"></i> </a>
                        </div>

                        <div class="flex-fill mt-2 fs-7" style="overflow-y: scroll;">
                            <div class="">
                                <ul class="list-group">
                                    <li class="list-group-item ps-0 pe-0 border-0 d-flex justify-content-between align-items-center">
                                        <div class="ms-0 me-auto">
                                            <div class="fw-normal">{{ "Supply Agreement.docx"}}</div>
                                            <span class="fs-8 fst-italic">
                                                {{ "Wed ,Jun 15 2022 11:38:44 pm" }}
                                            </span>
                                        </div>
                                        <i class="bi bi-file-earmark-medical mx-2"></i>
                                    </li>
                                    <li class="list-group-item ps-0 pe-0 border-0 d-flex justify-content-between align-items-center">
                                        <div class="ms-0 me-auto">
                                            <div class="fw-normal">{{ "Supply Agreement.docx"}}</div>
                                            <span class="fs-8 fst-italic">
                                                {{ "Wed ,Jun 15 2022 11:38:44 pm" }}
                                            </span>
                                        </div>
                                        <i class="bi bi-file-earmark-medical mx-2"></i>
                                    </li>
                                    <li class="list-group-item ps-0 pe-0 border-0 d-flex justify-content-between align-items-center">
                                        <div class="ms-0 me-auto">
                                            <div class="fw-normal">{{ "Supply Agreement.docx"}}</div>
                                            <span class="fs-8 fst-italic">
                                                {{ "Wed ,Jun 15 2022 11:38:44 pm" }}
                                            </span>
                                        </div>
                                        <i class="bi bi-reply mx-2"></i>
                                    </li>
                                    <li class="list-group-item ps-0 pe-0 border-0 d-flex justify-content-between align-items-center">
                                        <div class="ms-0 me-auto">
                                            <div class="fw-normal">{{ "Supply Agreement.docx"}}</div>
                                            <span class="fs-8 fst-italic">
                                                {{ "Wed ,Jun 15 2022 11:38:44 pm" }}
                                            </span>
                                        </div>
                                        <i class="bi bi-save mx-2"></i>
                                    </li>
                                    <li class="list-group-item ps-0 pe-0 border-0 d-flex justify-content-between align-items-center">
                                        <div class="ms-0 me-auto">
                                            <div class="fw-normal">{{ "Supply Agreement.docx"}}</div>
                                            <span class="fs-8 fst-italic">
                                                {{ "Wed ,Jun 15 2022 11:38:44 pm" }}
                                            </span>
                                        </div>
                                        <i class="bi bi-save mx-2"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ApproveConfirmationModal -->
        <div class="modal fade" id="ApproveConfirmationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="d-flex justify-content-start">
                            <div class="me-3">
                                <div class="bg-info p-1 rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-info" viewBox="0 0 16 16">
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-weight-bold">
                                    Accounts Approval
                                </h3>
                                
                                <p class="mt-4 fs-6 mb-0">
                                    You are about to approve this account,
                                </p>

                                <p class="fs-5 text-capitalize mb-0" v-if="this.AccountType == 'farmer'">
                                    <span class="fw-bold"> {{ this.UserAccountInfo[0].user_detail.fname +' '+  this.UserAccountInfo[0].user_detail.lname }} </span> , <span class=""> {{ this.UserAccountInfo[0].user_detail.farm_detail.farm_name }} </span>
                                </p>

                                <p class="fs-5 text-capitalize mb-0" v-else>
                                    <span class="fw-bold"> {{ this.UserAccountInfo[0].user_detail.fname +' '+  this.UserAccountInfo[0].user_detail.lname }} </span> , <span class=""> {{ this.UserAccountInfo[0].user_detail.business_detail.business_name }} </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-default btn-small text-main-green" data-bs-dismiss="modal" @click="approveAccount(this.UserAccountInfo[0].id)" >
                            Approve? <i class="bi bi-check-circle" ></i>
                        </button>

                        <button type="button" class="btn btn-secondary btn-small" data-bs-dismiss="modal">
                            Cancel <i class="bi bi-back"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </component>
</template>

<script defer>
    import { Inertia } from '@inertiajs/inertia'
    import AgrihubLayout from '@/Layouts/AgrihubLayout.vue'
    import CaGoLayout from '@/Layouts/CaGoLayout.vue'
    import JetModal from '@/Jetstream/Modal'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
	import Swal from 'sweetalert2'
    import ToastComponent from '../../Components/Toasts.vue'
    import HarvestComponent from '../../Components/Farmer/Harvest.vue'
    import OrderComponent from '../../Components/Trader/Order.vue'
    import AccumulatedAmountFarmer from '../../Components/Farmer/AccumulatedAmount.vue'
    import AccumulatedAmountTrader from '../../Components/Trader/AccumulatedAmount.vue'
    import FeaturedTransaction from '../../Components/FeaturedTransaction.vue'
    import Helpers from '../../Mixins/Helpers.js'
    import { Link } from '@inertiajs/inertia-vue3'
    import { shallowRef } from "vue"; 

    export default {
        components: {
            Link,
            AgrihubLayout,
            CaGoLayout,
            ToastComponent,
            JetModal,
            JetDialogModal,
            JetConfirmationModal,
            Swal,
            HarvestComponent,
            OrderComponent,
            AccumulatedAmountFarmer,
            AccumulatedAmountTrader,
            FeaturedTransaction,
        },
        mixins: [Helpers],
        props: ['UserAccountInfo','AccountType', 'RoutePrefix'],
		data() {
			return {
                layout: shallowRef('div'),
            }
        },
        methods: {
            viewSpecificAccount(data){
                console.log(data);
            },
            approveAccount(id){
                axios.post(route(this.RoutePrefix+'.ApproveUserAccount'), { user_id: id })
                .then((response)=>{
                    console.log(response.data);
                    if(response.data == 1){
                        Swal.fire({
                            title: 'Success!',
                            html: '<p class="fs-5 text-capitalize mb-0"> <span class="fw-bold">'+ this.UserAccountInfo[0].user_detail.fname +' '+ this.UserAccountInfo[0].user_detail.lname +' </span> has been Approved and Verified! </p>' +
                            
                            '<p class="fs-8 text-capitalize mb-0"> An automated confirmation message was sent to the '+ this.UserAccountInfo[0].user_detail.fname +' '+ this.UserAccountInfo[0].user_detail.lname+ ' via sms. </p>',
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
            },
        },
        mounted: function(){
            // Check if approved or pending
            if(this.UserAccountInfo[0].status == 'pending'){
                $('.pending-accounts').html('<p class="text-wrap fs-8 text-break">No data retrieved</p>');
                $('.pending-accounts').css('opacity', '80%');
                $('.pending-accounts').css('background-color', '#eee');
            }else{
                $('.pending-accounts').addClass('bg-white');
            }
        },
        created: function(){
			console.log("this.UserAccountInfo");
			console.log(this.UserAccountInfo);

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
