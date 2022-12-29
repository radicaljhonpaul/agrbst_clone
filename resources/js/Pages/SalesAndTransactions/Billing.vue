<style scoped>
    :focus {outline:0 !important;}
</style>
<template>
    <link rel="stylesheet" href="../../../css/table.css">
    <link rel="stylesheet" href="../../../css/content.css">

    <component :is="layout">
        <div class="container-fluid">
            <section class="d-flex justify-content-between mt-0 mb-0 mx-2">
                <div class="mb-2">
                    <p class="fs-6 mb-0 fw-bolder text-capitalize" v-text="'Invoice'"></p> 
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 fs-8">   
                            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" :href="route('Agrihub.AgriHubDashboardIndex')" >Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Sales and Transactions</li>
                            <li class="breadcrumb-item" role="button" @click="this.go_back()" aria-current="page"> Payment History </li>
                            <li class="breadcrumb-item" role="button" @click="this.go_back()" aria-current="page" > {{ this.TrasactionData.Transaction_No }} </li>
                            <li class="breadcrumb-item active" aria-current="page" v-if="!InvoiceData"> Billing Invoice </li>
                            <li class="breadcrumb-item active" aria-current="page" v-if="InvoiceData" v-cloak> {{ 'Reference No.: ' + this.InvoiceData.reference_no }} </li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <button class="btn btn-outline-main-1 btn-sm " type="button" @click="generatePDF(TrasactionData.Transaction_No)"> Download <i class="bi bi-download"></i> </button>
                    </div>
                </div>
            </section>
            
            <div ref="content" id="element-to-convert">
                <div v-if="InvoiceData">
                    <partial-invoice v-if="InvoiceData.remarks == 'partial' || InvoiceData.remarks == 'final'" :TrasactionData="TrasactionData" :InvoiceData="InvoiceData" :PayorsData="PayorsData" :Demands="Demands"></partial-invoice>
                    <full-invoice v-else :TrasactionData="TrasactionData" :InvoiceData="InvoiceData" :PayorsData="PayorsData" :Demands="Demands"></full-invoice>
                </div>
                <div v-if="!InvoiceData">
                    <invoice :TrasactionData="TrasactionData" :InvoiceData="InvoiceData" :PayorsData="PayorsData" :Demands="Demands"></invoice>
                </div>
            </div>
            
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
    import FullInvoice from '../../Components/FullInvoice.vue'
    import PartialInvoice from '../../Components/PartialInvoice.vue'
    import Invoice from '../../Components/Invoice.vue'
    import { shallowRef } from "vue"; 
    import { Link } from '@inertiajs/inertia-vue3'
    import Helpers from '../../Mixins/Helpers.js'
    import zipcodes from 'zipcodes-ph';
    import html2pdf from "html2pdf.js";

    export default {
        components: {
            AgrihubLayout,
            CaGoLayout,
            Modal,
            Swal,
            TableComponent,
            TablePagination,
            Link,
            PartialInvoice,
            Invoice,
            FullInvoice,
        },
        mixins: [Helpers],
        props: ['TrasactionData', 'InvoiceData', 'PayorsData', 'Demands', 'RoutePrefix'],
		data() {
			return {
                layout: shallowRef('div'),
            }
        },
        methods: {
            textCapitalize(phrase){
                return phrase.replace(/\w\S*/g, (w) => (w.replace(/^\w/, (c) => c.toUpperCase())));
            },
            generatePDF(transaction_no) {
                html2pdf(document.getElementById("element-to-convert"), {
                    margin: 0.25,
                    filename: transaction_no+".pdf",
                });
            }
        },
        created: function(){
			console.log("Billing");
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
