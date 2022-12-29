<template>
    <!-- Modal -->
    <div :data="data" :promptTitle="promptTitle" class="modal fade" id="promptModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"> {{ this.promptTitle }} </h5>
            </div>
            <div class="modal-body">
                {{ this.data }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"> {{  }} </button>
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
        props: ['data', 'promptTitle'],
        methods:{
            
        },
        created(){
            console.log("Modal Component");
        },
        methods: {
            
        }
    }
</script>
