<style scoped>
    :focus {outline:0 !important;}
</style>
<template>

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
                    <table-component :AccountType="AccountType" :RoutePrefix="RoutePrefix" :tableHead="['ID No.', 'Last Updated' ,'Firstname','Lastname','Phone','Farm','Status','Action']" :tableTDData="[ 'officialID', 'updated_at', 'user_detail.fname', 'user_detail.lname', 'user_detail.phone', 'user_detail.farm_detail.farm_name', 'status' ]" :tableData="UsersAccounts.data" ></table-component>
                </div>

                <div class="col">
                    <table-pagination :links="UsersAccounts.links" :current_page="UsersAccounts.current_page" :prev_url="UsersAccounts.prev_page_url" :next_url="UsersAccounts.next_page_url" :total_page="UsersAccounts.last_page" :path="UsersAccounts.path"></table-pagination>
                </div>
            </section>
        </div>

</template>

<script>
    import CaGoLayout from '@/Layouts/CaGoLayout.vue'
    import Modal from '@/Jetstream/Modal'
	import Swal from 'sweetalert2'
    import TablePagination from '../../../Components/TablePagination.vue'
    import TableComponent from '../../../Components/Table.vue'

    export default {
        components: {
            AgrihubLayout,
            CaGoLayout,
            Modal,
            Swal,
            TableComponent,
            TablePagination,
        },
        props: ['Commitments'],
		data() {
			return {

            }
        },
        methods: {
            
        },
        created: function(){
			console.log("Commitments");
			// console.log(this.UsersAccounts);
        }
    }
</script>
