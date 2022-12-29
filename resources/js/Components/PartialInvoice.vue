
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
                                            <span class="fw-bold"> Due Date : </span>
                                            <!-- 3 days -->
                                            <span v-if="InvoiceData.remarks == 'partial'"> {{ this.DateFormatDateOnly(this.dueDate(this.TrasactionData.Created, 3))  }} </span>
                                            <!-- 3 days -->
                                            <span v-else> {{ this.DateFormatDateOnly(this.dueDate(this.TrasactionData.Created, 30))  }} </span>
                                            <!-- <span v-if="this.DateFormatDateOnly(this.TrasactionData.DeliveryDue) != 'Invalid date'" v-html="this.DateFormatDateOnly(this.TrasactionData.DeliveryDue)"></span> -->
                                        </div>
                                    </div>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="text-left">DESCRIPTION</th>
                                            <th class="text-left">QTY</th>
                                            <th class="text-left">PRICE</th>
                                            <th class="text-right">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr >
                                            <td class="text-left text-capitalize">
                                                <!-- Check if Partial or Final -->
                                                <p class="fs-7 mb-0" v-if="InvoiceData.remarks == 'partial'">
                                                    Downpayment of <span class="fw-bold">{{ (this.dpPercentage * 100) +'%' }}</span> for
                                                    the following products:
                                                </p>
                                                <p class="fs-7 mb-0" v-else>
                                                    Final payment of <span class="fw-bold">{{ (this.dpPercentage * 100) +'%' }}</span> for
                                                    the following products:
                                                </p>
                                                
                                                <ol class="list-group list-group-numbered">
                                                    <li class="list-group-item bg-transparent border-0 fs-7" v-for="item in Demands" :key="item"> {{ item.crop.name }} </li>
                                                </ol>
                                            </td>
                                            <td class="">
                                                <p class="fs-7 mb-0">
                                                    &nbsp;
                                                </p>
                                                <ol class="list-group">
                                                    <li class="list-group-item bg-transparent border-0 fs-7" v-for="item in Demands" :key="item"> {{ item.qty +' kg' }} </li>
                                                </ol>
                                            </td>
                                            <td class="qty">
                                                <p class="fs-7 mb-0">
                                                    &nbsp;
                                                </p>
                                                <ol class="list-group">
                                                    <li class="list-group-item bg-transparent border-0 fs-7" v-for="item in Demands" :key="item"> {{ this.MondeyDigitFormat(item.crop.crop_pricing.smp) }} </li>
                                                </ol>
                                            </td>
                                            <td class="total">
                                                <p class="fs-7 mb-0">
                                                    &nbsp;
                                                </p>
                                                <ol class="list-group">
                                                    <li class="list-group-item bg-transparent text-white border-0 fs-7" v-for="item in Demands" :key="item"> {{ this.MondeyDigitFormat(item.amount) }} </li>
                                                </ol>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="1"></td>
                                            <td colspan="2" class="fs-7">SUBTOTAL</td>
                                            <td class="fs-7">
                                                <span v-html="this.MondeyDigitFormat(parseFloat(this.TrasactionData.Amount))"></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="1"></td>
                                            <td colspan="2" class="fs-7">
                                                <p class="mb-0"> DOWNPAYMENT ({{ (this.dpPercentage * 100) +'%' }}) </p>

                                                <!-- Check if final ang remarks -->
                                                <span v-if="InvoiceData.remarks == 'final'" class="badge text-main-green bg-main-green-118-opacity rounded-pill text-capitalize fs-8 fw-light" style="padding-top: 0.3rem;padding-bottom: 0.3rem;padding-left: 0.6rem;padding-right: 0.6rem;">
                                                    <i class="bi bi-circle-fill"></i> Paid last - {{ this.DateFormatDateOnly(TrasactionData.PreviousPayment.created_at) }}
                                                </span>
                                            </td>
                                            <td class="fs-7">
                                                <span v-html="this.MondeyDigitFormat(this.dpResult)"></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="1"></td>
                                            <td colspan="2" class="fs-7">VAT {{ this.vatPercentage +'%' }}</td>
                                            <td class="fs-7">
                                                <span v-html="this.MondeyDigitFormat(this.vatResult)"></span>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="1"></td>
                                            <td colspan="2" class="fs-7">
                                                <p class="mb-0">GRAND TOTAL</p>
                                                <span >less Downpayment (50%)</span> <br>
                                                <span v-if="InvoiceData.status == 'paid'" class="badge text-main-green bg-main-green-118-opacity rounded-pill text-capitalize fs-8 fw-light" style="padding-top: 0.3rem;padding-bottom: 0.3rem;padding-left: 0.6rem;padding-right: 0.6rem;">
                                                    <i class="bi bi-circle-fill"></i> Paid last - {{ this.DateFormatDateOnly(InvoiceData.updated_at) }}
                                                </span>
                                            </td>
                                            <td class="fs-7">
                                                <span v-html="this.MondeyDigitFormat(this.dpResult)"></span>
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
