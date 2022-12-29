<style scoped>
    :focus {outline:0 !important;}
</style>
<template>
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/content.css">

    <component :is="layout">
        <div class="container-fluid">
            <section class="d-flex justify-content-between mt-0 mb-0 mx-2">
                <div class="">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 fs-8">
                            <li class="breadcrumb-item"><a :href="route('Agrihub.AgriHubDashboardIndex')" >Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Farmer Accounts</li>
                        </ol>
                    </nav>

                    <p class="fs-6 fw-bolder text-capitalize" v-text="(AccountType) + ' Accounts'"></p> 
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
                <div class="col-12 fixTableHead">
                    <!-- <table-component v-if="AccountType == 'farmer'" :tableHead="['ID No.','Firstname','Lastname','Phone','Farm','Status', 'Date','Action']" :tableTDData="[ 'officialID', 'user_detail.fname', 'user_detail.lname', 'user_detail.phone', 'user_detail.farm_detail.farm_name', 'status', 'created_at' ]" :tableData="UsersAccounts.data" ></table-component> -->
                    <table-component v-if="AccountType == 'farmer'" :AccountType="AccountType" :RoutePrefix="RoutePrefix" :tableHead="['ID No.', 'Last Updated' ,'Firstname','Lastname','Phone','Farm','Status','Action']" :tableTDData="[ 'officialID', 'updated_at', 'user_detail.fname', 'user_detail.lname', 'user_detail.phone', 'user_detail.farm_detail.farm_name', 'status' ]" :tableData="UsersAccounts.data" ></table-component>
                    <table-component v-else :AccountType="AccountType" :RoutePrefix="RoutePrefix" :tableHead="['ID No.', 'Last Updated' ,'Firstname','Lastname','Phone','Business','Status','Action']" :tableTDData="[ 'officialID', 'updated_at', 'user_detail.fname', 'user_detail.lname', 'user_detail.phone', 'user_detail.business_detail.business_name', 'status' ]" :tableData="UsersAccounts.data" ></table-component>
                </div>

                <div class="col">
                    <table-pagination :links="UsersAccounts.links" :current_page="UsersAccounts.current_page" :prev_url="UsersAccounts.prev_page_url" :next_url="UsersAccounts.next_page_url" :total_page="UsersAccounts.last_page" :path="UsersAccounts.path"></table-pagination>
                </div>
            </section>
        </div>

		<!-- Modal for Viewing Document -->
		<!-- <modal :show="SpecificUserAccountModal" v-cloak>
			<div class="py-2">

            <div class="flex px-4 py-5 sm:px-6">
                
            <div class="flex-1">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                Account Information
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Personal details.
                </p>
            </div>
            <div class="flex-1"></div>
            <div class="flex-1 mr-auto">
                
            </div>
            </div>


                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                            Full name
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ SpecificUserAccountData.users_details.fname +' '+ SpecificUserAccountData.users_details.lname }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                            Application for
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ SpecificUserAccountData.user_type }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                            Contact/Email Address
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ SpecificUserAccountData.users_details.phone }} <br>
                            {{ SpecificUserAccountData.email }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                    
                    <span v-if="SpecificUserAccountData.user_type == 'Farmer'">Farm details </span> <span v-else>Entity details</span>
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    </p>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                <span v-if="SpecificUserAccountData.users_details.entity_details != null">
                                    Business Name
                                </span>
                                <span v-if="SpecificUserAccountData.users_details.farm_details != null">
                                    Farm/Farm Organization
                                </span>
                            </dt>
                            <dd v-if="SpecificUserAccountData.users_details.entity_details != null" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ SpecificUserAccountData.users_details.entity_details.entity_name }}
                            </dd>
                            <dd v-if="SpecificUserAccountData.users_details.farm_details != null" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ SpecificUserAccountData.users_details.farm_details.farm_name }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                <span v-if="SpecificUserAccountData.users_details.entity_details != null">
                                    Nature of Business and Permit No.
                                </span>
                                <span v-if="SpecificUserAccountData.users_details.farm_details != null">
                                    Farm Size (Sqare meter)
                                </span>
                            </dt>
                            <dd v-if="SpecificUserAccountData.users_details.entity_details != null" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ SpecificUserAccountData.users_details.entity_details.nature_of_entity }} <br>
                                {{ SpecificUserAccountData.users_details.entity_details.business_permit_no }}
                            </dd>
                            <dd v-if="SpecificUserAccountData.users_details.farm_details != null" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ SpecificUserAccountData.users_details.farm_details.farm_size +' ㎡'}}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                            Adress
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <span v-if="SpecificUserAccountData.users_details.entity_details != null">
                                    {{ SpecificUserAccountData.users_details.entity_details.brgy +', '+ SpecificUserAccountData.users_details.entity_details.city }} <br>
                                    {{ SpecificUserAccountData.users_details.entity_details.province }}
                                </span>

                                <span v-if="SpecificUserAccountData.users_details.farm_details != null">
                                    {{ SpecificUserAccountData.users_details.farm_details.brgy +', '+ SpecificUserAccountData.users_details.farm_details.city }} <br>
                                    {{ SpecificUserAccountData.users_details.farm_details.province }}
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>

                <section class="px-3 pt-3 pb-1 border-t flex justify-between items-center">
                    <button v-if="SpecificUserAccountData.status == 'Pending' || SpecificUserAccountData.status == null" @click="approveUser(SpecificUserAccountData.id)" type="button" class="focus:outline-none bg-white text-xs text-green-500 hover:bg-green-500 uppercase hover:shadow-lg hover:text-white border border-green-500 rounded-full px-3 py-1 mx-0 outline-none">
                        Approve <i class="fad fa-check-circle"></i>
                    </button>
                    <div class="inline-flex gap-3 ml-auto">
                        <button @click="SpecificUserAccountModal = false;" type="button" class="focus:outline-none bg-white text-xs text-red-500 hover:bg-red-500 uppercase hover:shadow-lg hover:text-white border border-red-500 rounded-full px-3 py-2 mx-0 outline-none">
                            close <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                </section>
			</div>
		</modal> -->
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

    export default {
        components: {
            AgrihubLayout,
            CaGoLayout,
            Modal,
            Swal,
            TableComponent,
            TablePagination,
        },
        props: ['UsersAccounts','AccountType', 'RoutePrefix'],
		data() {
			return {
				SpecificUserAccountModal: false,
                SpecificUserAccountData: null,
                layout: shallowRef('div'),
            }
        },
        methods: {
            
        },
        created: function(){
			// console.log("this.UsersAccounts.data");
			// console.log(this.UsersAccounts);
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
