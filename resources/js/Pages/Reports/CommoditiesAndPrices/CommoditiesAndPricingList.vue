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
                    Commodities and Pricing
                </h2> 

            </section>

            <section class="container-fluid px-4">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 text-xs">
                        <thead class="bg-gray-50 text-xs">
                            <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                                Crop ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                                Crop/Commodity
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                                Type
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                                FGP
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                                SRP
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 tracking-wider">
                                Action
                            </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="commodities in CommoditiesAndPricing.data" :key="commodities">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class=" font-medium text-gray-900">
                                        {{ commodities.id }}
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class=" font-medium text-gray-900">
                                        {{ commodities.name }}
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class=" font-medium text-gray-900">
                                        {{ commodities.crop_type }}
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class=" font-medium text-gray-900">
                                        {{ '₱ '+commodities.crop_pricing.fgp }}
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class=" font-medium text-gray-900">
                                        {{ '₱ '+commodities.crop_pricing.srp }}
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right font-medium">
                                <button @click="viewCommoditiesAndPricing(commodities.id)" type="button" class="group relative w-full flex justify-center py-1 px-2 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
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
            </section>

            <section class="container-fluid">
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
            Pagination,
        },
        props: ['CommoditiesAndPricing'],
		data() {
			return {
				CommoditiesAndPricingModal: false,
                SpecificCommoditiesAndPricingData: null,
            }
        },
        methods: {
            viewCommoditiesAndPricing(id){
			    console.log(id);
                this.$inertia.get(route('Agrihub.SpecificCommoditiesAndPricing'),
                {
                    id: id,
                },
                { replace: true })
            },
        },
        created: function(){
			console.log("CommoditiesAndPricing");
			console.log(this.CommoditiesAndPricing);
			console.log("CommoditiesAndPricing");
        }
    }
</script>
