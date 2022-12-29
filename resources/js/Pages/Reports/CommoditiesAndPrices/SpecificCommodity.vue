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
                    Commodity : {{ SpecificCommodity[0].name }}
                </h2> 
            </section>

            <section class="container-fluid px-4">
                <div class="flex py-5">
                    <div class="flex-1 pr-2">
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                    Varieties
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <span v-for="variety in SpecificCommodity[0].varieties" :key="variety" class="px-2 inline-flex text-xs font-semibold rounded-full bg-blue-500 text-white">
                                            {{ variety.variety_name }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-white px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Farmgate Price
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ '₱ '+SpecificCommodity[0].crop_pricing.fgp }} <br>
                                    </dd>
                                </div>

                                <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Social Retail Price
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ '₱ '+SpecificCommodity[0].crop_pricing.srp }} <br>
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
                                        Distance Row
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ SpecificCommodity[0].crop_production_model.dr +'m' }} <br>
                                    </dd>
                                </div>

                                <div class="bg-white px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Distance Hill
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ SpecificCommodity[0].crop_production_model.dh +'m' }} <br>
                                    </dd>
                                </div>

                                <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Harvesting
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ SpecificCommodity[0].crop_production_model.harvesting + ' instances per week' }} <br>
                                    </dd>
                                </div>

                                <div class="bg-white px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Maturity
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ SpecificCommodity[0].crop_production_model.maturity_from + ' - ' +  SpecificCommodity[0].crop_production_model.maturity_to + ' days'}} <br>
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
                                        Harvesting Span
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ SpecificCommodity[0].crop_production_harvesting_model.length + ' Weeks'}} <br>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
                
            </section>

            <section class="container-fluid px-4">
                <div class="bg-white px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                    <h5>
                        Weekly Harvest Distribution for <span class="font-bold"> {{ SpecificCommodity[0].crop_production_model.qty_hills +' Hills'}} </span> 
                    </h5>
                </div>

                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 text-xs">
                        <thead class="bg-gray-50 text-xs">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                                    Week No
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                                    Harvest Value
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                                    Harvest Unit
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="distrib in SpecificCommodity[0].crop_production_harvesting_model" :key="distrib">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class=" font-medium text-gray-900">
                                            {{ distrib.week_no }}
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class=" font-medium text-gray-900">
                                            {{ distrib.value }}
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class=" font-medium text-gray-900">
                                            Kilo
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
        props: ['SpecificCommodity'],
		data() {
			return {
				SpecificCommodityModal: false,
                SpecificCommoditysData: null,
            }
        },
        methods: {
            dateFormat(date_data){
                return moment(date_data).format('MMM DD, YYYY');
            },
            editPrice(id){
                
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
			console.log(this.SpecificCommodity);
        }
    }
</script>
