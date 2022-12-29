<template>
    <!-- Modal -->
    <div :data="data" class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ this.data }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
    import StatusBadge from './StatusBadge.vue'
    import Helpers from '../Mixins/Helpers.js'

    export default {
        components: {
            StatusBadge,
        },
        mixins: [Helpers],
        props: ['data'],
        methods:{
            
        },
        created(){
            console.log("Modal Component");
            console.log(this.data);
        },
    }
</script>
