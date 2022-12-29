<template>
    <link rel="stylesheet" href="../../../css/invoice.css">
    <div class="container" :TrasactionData="TrasactionData" :InvoiceData="InvoiceData" :PayorsData="PayorsData" :Demands="Demands">
        <div class="card">
            <div class="card-body">
                <div id="invoice">
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
                                        <div class="fs-7 fw-bold text-gray-light">Invoice to:</div>
                                        <p class="fs-4 to text-capitalize" v-html="this.PayorsData.fname +' '+ this.PayorsData.lname"></p>
                                        <div class="address text-capitalize" v-html="this.PayorsData.brgy +'., '+ this.PayorsData.city"></div>
                                        <div class="address text-capitalize" v-html="this.PayorsData.province +', '+ this.PayorsData.region"></div>
                                        <div class="email"><a href="mailto:{{ this.PayorsData.user.email }}" v-html="this.PayorsData.user.email"></a>
                                        </div>
                                    </div>
                                    <div class="col invoice-details">
                                        <div class="fs-7 fw-bold text-gray-light">Invoice No.</div>
                                        <div class="fs-4 invoice-id" v-html="this.TrasactionData.Transaction_No"></div>
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
                                                <span class="fs-9" v-html="item.crop.crop_type"></span>
                                            </td>
                                            <td class="fs-7">
                                                <span v-html="item.qty"></span>
                                            </td>
                                            <td class="qty fs-7">
                                                <span v-html="this.MondeyDigitFormat(item.crop.crop_pricing.smp)"></span>
                                            </td>
                                            <td class="total fs-7">
                                                <span v-html="this.MondeyDigitFormat(item.amount)"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2" class="fs-7">SUBTOTAL</td>
                                            <td class="fs-7">
                                                <span v-html="this.MondeyDigitFormat(parseFloat(this.TrasactionData.Amount))"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="fs-7"></td>
                                            <td colspan="2" class="fs-7">VAT {{ this.vatPercentage +'%' }}</td>
                                            <td class="fs-7">
                                                <span v-html="this.MondeyDigitFormat(this.vatResult)"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="fs-7"></td>
                                            <td colspan="2" class="fs-7">
                                                <p class="mb-0">GRAND TOTAL</p>
                                            </td>
                                            <td class="fs-7">
                                                <span v-html="this.MondeyDigitFormat(this.grandTotal)"></span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="notices">
                                    <div>NOTICE:</div>
                                    <div class="notice">A finance charge of 0.5% will be made on unpaid balances 7 days after due date ({{ this.DateFormatDateOnly(this.TrasactionData.DeliveryDue) }}).</div>
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
