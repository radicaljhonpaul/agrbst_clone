<style scoped>
    /* Toggle B */
    input:checked ~ .dot {
    transform: translateX(100%);
    background-color: #fff;
    border: 2px solid #059669;
    }
</style>

<template>
    <agrihub-layout>
        <div class="autoscroll pt-4 ml-16" style="height:600px; overflow-y:auto;">
            <section class="container-fluid px-4">
                <h2 class="font-weight-bold text-lg text-gray-500 mb-2">
                    Sales and Transactions
                </h2> 

            </section>

            <section class="container-fluid px-4">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 text-xs">
                    <thead class="bg-gray-50 text-xs">
                        <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                            Tracking No.
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                            Crop/Product
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                            Qty for Bidding
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                            Receivable
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                            Payable
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                            Ratio
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                            Action
                        </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="transactions in SalesAndTransactions.data" :key="transactions">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class=" font-medium text-gray-900">
                                    {{ transactions.tracking_number }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class=" font-medium text-gray-900">
                                    {{ transactions.crops[0].name }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class=" font-medium text-gray-900">
                                    {{ transactions.total_remaining_qty - transactions.bids_sum_qty }} <span v-if="transactions.total_remaining_qty > 1"> Kilos </span> <span v-if="transactions.total_remaining_qty <= 1"> Kilo </span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ '₱ '+ formatAmount(transactions.total_amount_srp) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                            {{ '₱ '+ formatAmount(transactions.total_amount_fgp) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span v-if="transactions.status == 'Pending'" class="px-2 inline-flex leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Pending
                            </span>
                            <span v-if="transactions.status == 'On-Process'" class="px-2 inline-flex leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-500">
                            On-Process
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex leading-5 font-semibold rounded-full bg-blue-500 text-white">
                            T - {{ transactions.demands_count }}
                            </span>
                            |
                            <span class="px-2 inline-flex leading-5 font-semibold rounded-full bg-green-500 text-white">
                            F - {{ transactions.bids_count }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right font-medium">
                            <button @click="SalesAndTransactionsModal = true, viewSalesAndTransactions(transactions.id)" type="button" class="group relative w-full flex justify-center py-1 px-2 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <span class="absolute right-1 inset-y-0 flex items-center pl-3">
                                    <i class="fad fa-chevron-double-right"></i>
                                </span>
                                View
                            </button>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <div class="flex pt-2 w-full overflow-x-auto">
					<!-- <pagination :links="SalesAndTransactions.links" :current_page="SalesAndTransactions.current_page" :prev_url="SalesAndTransactions.prev_page_url" :next_url="SalesAndTransactions.next_page_url" :total_page="SalesAndTransactions.last_page" :path="SalesAndTransactions.path"></pagination> -->
				</div>
            </section>
        </div>

    </agrihub-layout>
</template>

<script>
    import AgrihubLayout from '@/Layouts/AgrihubLayout.vue'
    import Modal from '@/Jetstream/Modal'
	import Swal from 'sweetalert2'

    export default {
        components: {
            AgrihubLayout,
            Modal,
            Swal,
        },
        props: ['SalesAndTransactions'],
		data() {
			return {
				SalesAndTransactionsModal: false,
                SpecificSalesAndTransactionsData: null,
            }
        },
        methods: {
            viewSalesAndTransactions(id){
			    console.log(id);
                this.$inertia.get(route('Agrihub.SpecificTransaction'),
                {
                    id: id,
                },
                { replace: true })
            },
            formatAmount(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            }
        },
        created: function(){
			console.log(this.SalesAndTransactions);
        }
    }
</script>
