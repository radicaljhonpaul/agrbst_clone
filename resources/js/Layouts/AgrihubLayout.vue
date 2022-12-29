<template> 
    <header>
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar shadow" >
            
            <a class="" href="#">
                <img src="/images/agrihublogo.png" style="width: 100%; height: 30px; margin-left: -25px; object-fit: contain;" alt="">
            </a>

            <div class="position-sticky mt-2 py-4 fs-7" id="sidebarMenuLinkDiv">
                    <p class="sidebar-heading text-green align-items-left fs-8 fw-bold px-3 my-3">
                        <span>Apps and Widgets</span>
                    </p>
                    <ul class="nav flex-column">
                        <li class="nav-item ">
                            <sidebar-link :href="route('Agrihub.AgriHubDashboardIndex')" :active="route().current('Agrihub.AgriHubDashboardIndex')">
                                Dashboard
                                <i class="bi bi-grid"></i> 
                            </sidebar-link>
                        </li>
                    </ul>

                    <p class="sidebar-heading text-green align-items-left fs-8 fw-bold px-3 my-3">
                        <span>Accounts</span>
                    </p>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            
                            <sidebar-link :href="route('Agrihub.UserAccounts')" :method="'get'" :data="{ perPage: '10', type: 'farmer' }" :active="$page.url  === '/Agrihub/UserAccounts?perPage=10&type=farmer'">
                                Farmer
                                <i class="bi bi-brightness-high"></i>
                            </sidebar-link>
                        </li>
                        <li class="nav-item">
                            <sidebar-link :href="route('Agrihub.UserAccounts')" :method="'get'" :data="{ perPage: '10', type: 'trader' }" :active="$page.url  === '/Agrihub/UserAccounts?perPage=10&type=trader'">
                                Trader
                                <i class="bi bi-cart3"></i>
                            </sidebar-link >
                        </li>
                    </ul>

                    <p class="sidebar-heading text-green align-items-left fs-8 fw-bold px-3 my-3">
                        <span>Activity</span>
                    </p>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <sidebar-link :href="route('Agrihub.SalesAndTransactionsIndex')" :active="$page.url.startsWith('/Agrihub/SalesAndTransactions')">
                                Sales & Transactions
                                <i class="bi bi-graph-up-arrow"></i>
                            </sidebar-link>
                        </li>
                    </ul>

                    <p class="sidebar-heading text-green align-items-left fs-8 fw-bold px-3 my-3">
                        <span>Commodities & Pricing</span>
                    </p>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between" href="#">
                                Commodities & Pricing
                                <i class="bi bi-tag"></i>
                            </a>
                        </li>
                    </ul>

                    <p class="sidebar-heading text-green align-items-left fs-8 fw-bold px-3 my-3">
                        <span>Inventory</span>
                    </p>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <sidebar-link :href="route('Agrihub.InventoryAndOrders')" :active="$page.url.startsWith('/Agrihub/InventoryAndOrders')">
                                Inventory & Orders
                                <i class="bi bi-box-seam"></i>
                            </sidebar-link>
                        </li>
                    </ul>

                    <p class="sidebar-heading text-green align-items-left fs-8 fw-bold px-3 my-3">
                        <span>Supply and Demand</span>
                    </p>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <sidebar-link :href="route('Agrihub.SupplyAndDemandsIndex')" :active="$page.url.startsWith('/Agrihub/SupplyAndDemands')">
                                Supply & Demand
                                <i class="bi bi-kanban"></i>
                            </sidebar-link>
                        </li>
                    </ul>

                    <p class="sidebar-heading text-green align-items-left fs-8 fw-bold px-3 my-3">
                        <span>Reports</span>
                    </p>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between" href="#">
                                Generate Reports
                                <i class="bi bi-file-bar-graph"></i>
                            </a>
                        </li>
                    </ul>
            </div>
        </nav>
    </header>

    <div id="main">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top" id="mainContentNavbar">
            <div class="container-fluid" style="margin-left:0px; padding-left:0px;">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>

                <div class="d-flex justify-content-end collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <a class="btn bg-main-green btn-sm text-white" id="sideBarBtn" @click="toggleSideBar(this.sidebarState)">
                            <i class="bi fs-5" :class="this.sidebarState == true ? 'bi-chevron-double-left' : 'bi-chevron-double-right'"></i>
                        </a>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav align-items-center ml-0">
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between fw-bolder" href="#" @click="logout()" role="button" aria-expanded="false">
                                <i class="bi bi-envelope fs-4"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between fw-bolder" href="#" role="button" aria-expanded="false">
                                <i class="bi bi-bell fs-4"></i>
                            </a>
                        </li>

                        <!-- Authentication Links -->
                        <jet-dropdown id="settingsDropdown">
                            <template #trigger>
                                <img class="rounded-circle" src="/images/Profile.jpg" style="width:30px; height:30px;" alt="">
                                <!-- <img v-if="$page.props.jetstream.managesProfilePhotos" class="rounded-circle" width="32" height="32" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" /> -->
                                <!-- <span v-else> -->
                                {{ $page.props.user.name }}

                                <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                <!-- </span> -->
                            </template>

                            <template #content style="z-index: 999;">
                            <!-- Account Management -->
                            <h6 class="dropdown-header small text-muted">
                                Manage Account
                            </h6>

                            <jet-dropdown-link :href="route('profile.show')">
                                Profile
                            </jet-dropdown-link>

                            <hr class="dropdown-divider">

                            <!-- Authentication -->
                            <form @submit.prevent="logout">
                                <jet-dropdown-link as="button" class="text-right">
                                    <i class="bi bi-box-arrow-right"></i>
                                    Log out
                                </jet-dropdown-link>
                            </form>
                            </template>
                        </jet-dropdown>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container-fluid my-3 mb-2">
            <!-- Page Content -->
            <slot></slot>
        </main>
        
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
    import JetBanner from '@/Jetstream/Banner.vue'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
    import SidebarLink from '@/Components/SidebarLink.vue'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        props: {
            title: String,
        },

        components: {
            Head,
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            SidebarLink,
            JetResponsiveNavLink,
            Link,
        },

        data() {
            return {
                sidebarState: true,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
            toggleSideBar(){
                // console.log(this.sidebarState + " sidebar");
                if(this.sidebarState == true){
                    $("#sidebarMenu").css("width", "260px");
                    $("#main").css("margin-left", "260px");
                    
                    return this.sidebarState = false;
                }
                
                if(this.sidebarState == false){
                    $("#sidebarMenu").css("width", "0");
                    $("#main").css("margin-left", "0");
                    return this.sidebarState = true;

                }
            },
        },
        computed: {
            path() {
                return window.location.pathname
            }
        },
        created: function(){
            console.log("agrihub layout");
        },
        mounted: function(){
            // console.log(this.sidebarState);
            this.toggleSideBar(this.sidebarState);
        },
    })
</script>