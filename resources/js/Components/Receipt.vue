<style scoped>

    body{margin-top:20px;
        background-color: #f7f7ff;
    }
    #invoice {
        padding: 0px;
    }

    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
        padding: 15px
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #0d6efd
    }

    .invoice .company-details {
        text-align: right
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .contacts {
        margin-bottom: 20px
    }

    .invoice .invoice-to {
        text-align: left
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #0d6efd
    }

    .invoice main {
        padding-bottom: 50px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #0d6efd;
        background: #e7f2ff;
        padding: 10px;
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }

    .invoice table td,
    .invoice table th {
        padding: 15px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #0d6efd;
        font-size: 1.2em
    }

    .invoice table .qty,
    .invoice table .total,
    .invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #0d6efd
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total {
        background: #0d6efd;
        color: #fff
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0px solid rgba(0, 0, 0, 0);
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }

    .invoice table tfoot tr:last-child td {
        color: #0d6efd;
        font-size: 1.4em;
        border-top: 1px solid #0d6efd
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    @media print {
        .invoice {
            font-size: 11px !important;
            overflow: hidden !important
        }
        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }
        .invoice>div:last-child {
            page-break-before: always
        }
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #0d6efd;
        background: #e7f2ff;
        padding: 10px;
    }
</style>

<template>
    <div class="container" :TrasactionData="TrasactionData" :InvoiceData="InvoiceData" :PayorsData="PayorsData" :Demands="Demands">
        <div class="card">
            <div class="card-body">
                <div id="invoice">
                    <!-- <div class="toolbar hidden-print">
                        <div class="text-end">
                            <button type="button" class="btn btn-dark"><i class="fa fa-print"></i> Print</button>
                            <button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                        </div>
                        <hr>
                    </div> -->
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">
                                    <div class="col">
                                        <img style="width:40%;" src="/images/agrihubLogo.png" alt="">
                                    </div>
                                    <div class="col company-details">
                                        <p class="fs-2 fw-bold name">
                                            AgriHub
                                        </p>
                                        <div>City Hall Bldg., JP Rosales Ave.,</div>
                                        <div>Doongan, Butuan City</div>
                                        <a href="">agrihub.agriboost@butuan.gov.ph</a>
                                    </div>
                                </div>
                            </header>
                            <main>
                                <div class="row contacts">
                                    <div class="col invoice-to">
                                        <div class="text-gray-light">INVOICE TO:</div>
                                        <h2 class="to text-capitalize" v-html="this.PayorsData.fname +' '+ this.PayorsData.lname"></h2>
                                        <div class="address text-capitalize" v-html="this.PayorsData.business_detail.brgy +'., '+ this.PayorsData.business_detail.city"></div>
                                        <div class="address text-capitalize" v-html="this.PayorsData.business_detail.province +', '+ this.PayorsData.business_detail.region"></div>
                                        <div class="email"><a href="mailto:john@example.com" v-html="this.PayorsData.user.email"></a>
                                        </div>
                                    </div>
                                    <div class="col invoice-details">
                                        <h1 class="invoice-id" v-html="this.TrasactionData.Transaction_No"></h1>
                                        <div class="date" >
                                            <span class="fw-bold"> Date of Invoice : </span> <span v-html="this.DateFormatDateOnly(this.TrasactionData.Created)"></span>
                                        </div>
                                        <div class="date" >
                                            <span class="fw-bold"> Due Date : </span> <span v-html="this.DateFormatDateOnly(this.TrasactionData.DeliveryDue)"></span>
                                        </div>
                                    </div>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">DESCRIPTION</th>
                                            <th class="text-left">QTY</th>
                                            <th class="text-left">PRICE</th>
                                            <th class="text-right">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in Demands" :key="item">
                                            <td class="no fs-7">{{ index+1 }}</td>
                                            <td class="text-left text-capitalize">
                                                <p class="fw-bold fs-7 mb-0" v-html="item.crop.name"></p>
                                                <span class="fs-8" v-html="item.crop.crop_type"></span>
                                            </td>
                                            <td class="unit">
                                                <span v-html="item.qty"></span>
                                            </td>
                                            <td class="qty">
                                                <span v-html="this.MondeyDigitFormat(item.crop.crop_pricing.smp)"></span>
                                            </td>
                                            <td class="total">
                                                <span v-html="this.MondeyDigitFormat(item.amount)"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">SUBTOTAL</td>
                                            <td>
                                                <span v-html="this.MondeyDigitFormat(parseFloat(this.TrasactionData.Amount))"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">VAT {{ this.vatPercentage +'%' }}</td>
                                            <td>
                                                <span v-html="this.MondeyDigitFormat(this.vatResult)"></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">DOWNPAYMENT {{ (this.dpPercentage * 100) +'%' }}</td>
                                            <td>
                                                <span v-html="this.MondeyDigitFormat(this.dpResult)"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">GRAND TOTAL</td>
                                            <td>
                                                <span v-html="this.MondeyDigitFormat(this.grandTotal)"></span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="notices">
                                    <div>NOTICE:</div>
                                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                                </div>
                            </main>
                            <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                        </div>
                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Helpers from '../Mixins/Helpers.js'

    export default {
        components: {
        },
        mixins: [Helpers],
        props: ['TrasactionData', 'InvoiceData', 'PayorsData', 'Demands'],
        data() {
			return {
                dpPercentage: .50,
                dpResult: null,
                vatPercentage: 0,
                vatResult: null,
                grandTotal: null,
            }
        },
        methods:{
            
        },
        created(){
            console.log("Invoice Component");
            console.log(this.TrasactionData);
            console.log(this.InvoiceData);
            console.log(this.PayorsData);
            console.log(this.Demands);
            console.log(this.TransactionNo);
            this.vatResult = parseFloat(this.TrasactionData.Amount) * (this.vatPercentage);
            this.dpResult = parseFloat(this.TrasactionData.Amount) * (this.dpPercentage);

            this.grandTotal = parseFloat(this.TrasactionData.Amount) - (this.vatResult);
            console.log(this.vatResult);
            console.log(this.grandTotal);
            

        },
    }
</script>
