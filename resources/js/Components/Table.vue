<template>
    <table :AccountType="AccountType" :tableData="tableData" :tableHead="tableHead" class="">
        <thead>
            <tr>
                <th v-for="th_value in tableHead" :key="th_value" scope="col" class="fs-7">
                    {{ th_value }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="fs-8" v-for="(item, index) in tableData" :key="item">
                <td class="align-middle" v-for="(itemz, indexz) in tableTDData" :key="itemz">
                    <span v-if="itemz == 'status'" class="text-wrap">
                        <status-badge :status="bindData(item,itemz)"></status-badge>
                    </span>
                    <span v-else-if="itemz == 'updated_at'" class="text-wrap" v-html="this.DateFormat(bindData(item,itemz))"> </span>
                    <span v-else class="text-wrap"> {{ bindData(item,itemz) }} </span>
                </td>

                <td>
                    <Link type="button" class="btn btn-table-default rounded-pill btn-sm" :href="route(this.RoutePrefix+'.UserAccountInfo')" :method="'GET'" :data="{ user_id: item.id , type: item.user_type }" > View <i class="bi bi-eye"></i> </Link>
                </td>
                
            </tr>
        </tbody>
    </table>
</template>
<script>
    import StatusBadge from './StatusBadge.vue'
    import Helpers from '../Mixins/Helpers.js'
    import { Link } from '@inertiajs/inertia-vue3'

    export default {
        
        components: {
            StatusBadge,
            Link,
        },
        mixins: [Helpers],
        props: ['tableData', 'tableHead', 'tableTDData', 'AccountType', 'RoutePrefix'],
        methods:{
            
        },
        created(){
            // console.log(this.tableData);
            // console.log(this.tableHead);
            // console.log(this.DateFormat('sdsd'));
        },
        methods: {
            bindData(objectData, objProperties){
                objProperties = objProperties.replace(/\[(\w+)\]/g, '.$1'); // convert indexes to properties
                objProperties = objProperties.replace(/^\./, '');           // strip a leading dot
                var splitHolder = objProperties.split('.');
                for (var i = 0, n = splitHolder.length; i < n; ++i) {
                    var indexesinSplitHolder = splitHolder[i];
                    if (indexesinSplitHolder in objectData) {
                        objectData = objectData[indexesinSplitHolder];
                    } else {
                        return;
                    }
                }
                return objectData;

            }
        }
    }
</script>
