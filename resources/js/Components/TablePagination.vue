<style scoped>
    .page-link{
        color: #339933;
    }

    .page-link:hover {
        z-index: 2;
        color: #339933;
        background-color: rgba(51, 153, 51, 0.521);
        border-color: rgba(51, 153, 51, 0.521);
    }
    .page-link:focus, .page-link:active {
        z-index: 3;
        color: #ffffff !important;
        background-color: #339933;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(51, 153, 51, 0.25);
    }

</style>
<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <Link class="page-link text-decoration-none" v-if="current_page > 1" :href="prev_url" aria-label="Previous">
                    <i class="bi bi-chevron-left"></i>
                </Link>
            </li>
            <!-- Loop for how many pages -->
            <li class="page-item"  v-for="link in total_page" :key="link">
                <!--Page link for numbers -->
                <Link class="page-link" :href="links[link].url" v-if="links[link] !== undefined && links[link].label.includes('Next') == false && links[link].label.includes('...') == false" aria-current="page" :class="{ 'bg-main-green text-white': current_page ==  links[link].label }">
                    {{ links[link].label }}
                </Link>
                <!-- add ... -->
                <Link class="page-link" :href="next_page_url" v-if="links[link] !== undefined && links[link].label.includes('...')" :class="{ 'bg-main-green': current_page ==  links[link].label }">
                    {{ links[link].label}}
                </Link>
            </li>
            <li class="page-item">
                <Link class="page-link" v-if="total_page != current_page" :href="next_url" aria-label="Next">
                    <i class="bi bi-chevron-right"></i>
                </Link>
            </li>
        </ul>
    </nav>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'

    export default {
        components: {
            Link,
        },
        props: {
            links: Array,
            current_page: Number,
            prev_url: "",
            next_url: "",
            total_page: Number,
            path: "",
        },
        created(){
        },
        methods:{

        }
    }
</script>