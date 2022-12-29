<style scoped>
    /* Tab content - closed */
    .tab-content {
    max-height: 0;
    -webkit-transition: max-height .35s;
    -o-transition: max-height .35s;
    transition: max-height .35s;
    }
    /* :checked - resize to full height */
    .tab input:checked ~ .tab-content {
    max-height: 100vh;
    }
    /* Label formatting when open */
    .tab input:checked + label{
    /*@apply text-xl p-2 border-l-2 border-green-500 bg-gray-100 text-green*/
    border-left-width: 2px; /*.border-l-2*/
    border-color: #10b981; /*.border-green*/
    background-color: #f8fafc; /*.bg-gray-100 */
    color: #10b981; /*.text-green*/
    }
    /* Icon */
    .tab label::after {
    float:right;
    right: 0;
    top: 0;
    display: block;
    width: 1.5em;
    height: 1.5em;
    line-height: 1.5;
    font-size: 1.25rem;
    text-align: center;
    -webkit-transition: all .35s;
    -o-transition: all .35s;
    transition: all .35s;
    }
    /* Icon formatting - closed */
    .tab input[type=checkbox] + label::after {
    content: "+";
    font-weight:bold; /*.font-bold*/
    border-width: 1px; /*.border*/
    border-radius: 9999px; /*.rounded-full */
    border-color: #b8c2cc; /*.border-grey*/
    }
    .tab input[type=radio] + label::after {
    content: "\25BE";
    font-weight:bold; /*.font-bold*/
    border-width: 1px; /*.border*/
    border-radius: 9999px; /*.rounded-full */
    border-color: #b8c2cc; /*.border-grey*/
    }
    /* Icon formatting - open */
    .tab input[type=checkbox]:checked + label::after {
    transform: rotate(315deg);
    background-color: #10b981; /*.bg-green*/
    color: #f8fafc; /*.text-grey-lightest*/
    }
    .tab input[type=radio]:checked + label::after {
    transform: rotateX(180deg);
    background-color: #10b981; /*.bg-green*/
    color: #f8fafc; /*.text-grey-lightest*/
    }
</style>

<template>
    <agrihub-layout>
        <div class="autoscroll pt-4 ml-16" style="height:600px; overflow-y:auto;">
            <section class="container-fluid px-4">
                <h2 class="font-bold text-md text-gray-500 mb-2">
                    Tracking No. {{ SpecificTransaction[0].tracking_number }}
                </h2> 
            </section>

            <section class="container-fluid px-4">
                <div class="flex py-5">
                    <div class="flex-1 pr-2">
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                    Product
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ SpecificTransaction[0].crops[0].name }}
                                    </dd>
                                </div>
                                <div class="bg-white px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                    Class
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ 'Class ' +SpecificTransaction[0].class }} <br>
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                    Variety
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ SpecificTransaction[0].variety }}
                                    </dd>
                                </div>
                                <div class="bg-white px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                    Delivery Date
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ dateFormat(SpecificTransaction[0].proposed_delivery_date) }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    <div class="flex-1 pr-2">
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Remaining Qty
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ SpecificTransaction[0].total_remaining_qty - SpecificTransaction[0].bids_sum_qty +' '+ this.return_unit(SpecificTransaction[0].total_remaining_qty) }} <br>
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Payable (Php)
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ SpecificTransaction[0].total_amount_fgp }} <br>
                                    </dd>
                                </div>
                                <div class="bg-white px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Recievable (Php)
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ SpecificTransaction[0].total_amount_srp }} <br>
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Net. Amount
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ Math.round(SpecificTransaction[0].total_amount_srp - SpecificTransaction[0].total_amount_fgp) }} <br>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    <div class="flex-1 pr-2">
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        No. of Traders
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ SpecificTransaction[0].demands_count }}
                                    </dd>
                                </div>
                                <div class="bg-white px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        No. of Farmers
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ SpecificTransaction[0].bids_count }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </section>

            <section class="container-fluid px-4">
                <h2 class="font-bold text-md text-gray-500 mb-2">
                    Commits
                </h2> 
                <div class="shadow-md">
                    <div class="tab w-full overflow-hidden border-t" v-for="commits in SpecificTransaction[0].bids" :key="commits">
                        <input class="absolute opacity-0" :id="'tab-single-one_'+commits.id" type="radio" name="tabs2">
                        <label class="block p-3 leading-normal cursor-pointer" :for="'tab-single-one_'+commits.id">
                            {{ commits.user.fname +' '+ commits.user.lname }} - 
                            <span v-if="commits.status == 'Pending'" class="px-2 inline-flex leading-5 font-semibold text-xs rounded-full bg-red-100 text-red-800">
                            Pending
                            </span>
                            <span v-else class="px-2 inline-flex leading-5 font-semibold text-xs rounded-full bg-green-100 text-green-800">
                            Approved
                            </span>
                        </label>
                        
                        
                        <div class="tab-content overflow-hidden border-l-2 border-green-500 leading-normal">
                            <div class="border-t border-gray-200">
                                <section class="container-fluid">
                                    <div class="flex">
                                        <div class="flex-1 pr-2">
                                            <div class="border-gray-200">
                                                <dl>
                                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Farm & Farm Size
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                            {{ commits.user.farm_details.farm_name }} <br>
                                                            {{ commits.user.farm_details.farm_size +' ㎡' }}
                                                        </dd>
                                                    </div>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="flex-1 pr-2">
                                            <div class="border-t border-gray-200">
                                                <dl>
                                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Qty
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                            {{ commits.qty }}
                                                            <span v-if="commits.qty > 1">
                                                                Kilos
                                                            </span>
                                                            <span v-if="commits.qty <= 1">
                                                                Kilo
                                                            </span>
                                                        </dd>
                                                    </div>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="flex-1 pr-2">
                                            <div class="border-t border-gray-200">
                                                <dl>
                                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Amount
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                            {{ commits.amount_receivable +' Php' }}
                                                        </dd>
                                                    </div>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <section class="px-2 py-3 flex justify-between items-center" v-if="this.checkRemainingBalance(SpecificTransaction[0].total_remaining_qty,SpecificTransaction[0].bids_sum_qty) != 0">
                                <button v-if="commits.status == 'Pending' || SpecificTransaction[0].bids[0].status == null" @click="approveCommit(commits.id)" type="button" class="focus:outline-none bg-white text-xs text-green-500 hover:bg-green-500 uppercase hover:shadow-lg hover:text-white border border-green-500 rounded-full px-3 py-1 mx-0 outline-none">
                                    Approve <i class="fad fa-check-circle"></i>
                                </button>
                                <!-- <div v-if="commits.status == 'Pending' || SpecificTransaction[0].bids[0].status == null" @click="approveCommit(commits.id)" class="inline-flex gap-3 ml-auto">
                                    <button type="button" class="focus:outline-none bg-white text-xs text-red-500 hover:bg-red-500 uppercase hover:shadow-lg hover:text-white border border-red-500 rounded-full px-3 py-1 mx-0 outline-none">
                                        Decline <i class="fad fa-times-circle"></i>
                                    </button>
                                </div> -->
                            </section>
                        </div>
                    </div>
                    
                   
                </div>
            </section>
        </div>

		<!-- Modal for Viewing Specific Transactions -->
    </agrihub-layout>
</template>

<script>
    import AgrihubLayout from '@/Layouts/AgrihubLayout.vue'
    import Modal from '@/Jetstream/Modal'
	import Swal from 'sweetalert2'
    import moment from 'moment';

    export default {
        components: {
            AgrihubLayout,
            Modal,
            Swal,
        },
        props: ['SpecificTransaction'],
		data() {
			return {
				SpecificTransactionsModal: false,
                SpecificTransactionsData: null,
            }
        },
        methods: {
            dateFormat(date_data){
                return moment(date_data).format('MMM DD, YYYY');
            },
            approveCommit(id){
                this.$inertia.get(route('Agrihub.ApproveCommit'), { id: id }, {
 					onSuccess: (res) => {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Farmer Commitment has been Approved!',
                            icon: 'success',
                            timer: 2000,
                            timerProgressBar: true,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                         console.log(res);
                     },
					onFinish: () => {
                    },
				});
            },
            return_unit(unit){
                if(unit > 1){
                    return 'Kilos';
                }else{
                    return 'Kilo';
                }
            },
            checkRemainingBalance(rem_qty,bids_qty){
                return rem_qty - bids_qty;
            }
        },
        created: function(){
			console.log(this.SpecificTransaction);
        }
    }
</script>
