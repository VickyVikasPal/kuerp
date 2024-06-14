<template>
<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
                     <breadcrumbs></breadcrumbs>
                </div>
               
            </div>
        </div>
    <GenericEdit v-if="generic" ref="loadGeneric"  :urls="urls"></GenericEdit>
    <CustomEdit v-else></CustomEdit>
    
</main>
</template>
<script>
import {ref} from 'vue'
import GenericEdit from '@/components/layout/shared/EditView.vue';
import CustomEdit from "@/views/modules/Orders/EditView.vue";
import breadcrumbs from "@/views/modules/Orders/MenuList.vue";
import lang from "@/views/modules/Orders/language/en.js";
export default {
    name:'edit-orders',
    components:{
        GenericEdit,
        CustomEdit,
        breadcrumbs,
    },
    data() {
        return {
            generic:true,
            metaList:[
            {
                        type: 'text',
                        name: 'customer_name',
                        label: lang.LBL_CUSTOMER_NAME,
                        required: true,
                    },
                    {
                        type: 'text',
                        name: 'firm_name',
                        label: lang.LBL_FIRM_NAME,
                        required: true,
                    },
                    {
                        type: 'text',
                        name: 'contact_number',
                        label: lang.LBL_CONTACT_NO,
                        required: true,
                    },
                    {
                        type: 'text',
                        name: 'email_id',
                        label: lang.LBL_EMAIL_ID,
                        required: true,
                    },
                    {
                        type: 'selectbox',
                        name: 'gst_status',
                        label: lang.LBL_GST_STATUS,
                        selected: 'Active',
                        items: [
                            { value: 'Active' },
                            { value: 'Deactive' },
                        ],
                        required: true,

                    },
                    {
                        type: 'text',
                        name: 'gst_number',
                        label: lang.LBL_GST_NUMBER,
                        required: true,
                    },
                    {
                        type: 'textarea',
                        name: 'description',
                        label: lang.LBL_ADDRESS,
                        required: false,
                    },
                   
                    {
                        type: 'text',
                        name: 'area',
                        label: lang.LBL_AREA,
                        required: false,
                    },
                    {
                        type: 'text',
                        name: 'state',
                        label: lang.LBL_STATE,
                        required: false,
                    },
                    {
                        type: 'text',
                        name: 'pin_number',
                        label: lang.LBL_PIN,
                        required: false,
                    },
            ],
            urls:'/modules/orders',
            
            routePath:{
                path:'orders',
                detail:false
            }
        }
    },
    mounted() {
        this.childMethod();
        this.lang = lang;
    },
    methods:{
        childMethod(){
            if(this.generic == true){
                this.$refs.loadGeneric.loadGenericView(this.metaList,this.routePath);
            }
            
        }
    },
}
</script>