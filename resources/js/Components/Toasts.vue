<template>
    <!-- Toasts -->
    <div :title="title" :body="body" :type="type" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
            <i v-if="type == 'info'" class="bi bi-info-square-fill"></i>
            <i v-if="type == 'success'" class="bi bi-check-square-fill"></i>
            <i v-if="type == 'warning'" class="bi bi-exclamation-square-fill"></i>
            <i v-if="type == 'notif'" class="bi bi-exclamation-square-fill"></i>
            <i v-if="type == 'error'" class="bi bi-x-square-fill"></i>
            <strong class="me-auto"> {{ title }} </strong>
            <!-- <small>11 mins ago</small> -->
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
            {{ body }}
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
        props: ['title', 'body', 'type'],
        methods:{
            
        },
        created(){
            console.log("Toasts Component");
        },
    }
</script>
