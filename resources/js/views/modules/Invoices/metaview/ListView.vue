<template>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                     <breadcrumbs></breadcrumbs>
                </div>
               
            </div>
        </div>
        <GenericList v-if="generic" ref="loadGeneric"></GenericList>
        <CustomList v-else></CustomList>
    </main>
</template>
<script>
import { ref } from "vue";
import GenericList from "@/components/layout/shared/ListView.vue";
import CustomList from "@/views/modules/Invoices/ListView.vue";
import searchArray from "@/views/modules/Invoices/metaview/metajs/SearchView.js";
import breadcrumbs from "@/views/modules/Invoices/MenuList.vue";
import lang from "@/views/modules/Invoices/language/en.js";

export default {
    name:'list-invoices',
    components:{
        GenericList,
        CustomList,
        breadcrumbs,
    },
    data(){
        return {
            generic:true,
            metaList:[
                {
                    label:lang.LBL_INVOICE_NO,
                    link:true,
                    routePath:'invoices',/// routePath is required at start of object
                    relatedModule:''
                },
                {
                    label:lang.LBL_CUSTOMER_NAME,
                    link:true,
                    routePath:'invoices',/// routePath is required at start of object
                    relatedModule:''
                },
                {
                    label:lang.LBL_TOTAL_VALUE,
                    link:false,
                    routePath:'',
                    relatedModule:''
                },
                {
                    label:lang.LBL_PAYMENT_STATUS,
                    link:false,
                    routePath:'',
                    relatedModule:''
                },
                {
                    label:lang.LBL_STATUS,
                    link:false,
                    routePath:'',
                    relatedModule:''
                },
                {
                    label:lang.LBL_DATE_ENTERED,
                    link:false,
                    routePath:'',
                    relatedModule:''
                },
            ],
            columns: ['invoice_no', 'firm_name', 'grand_total', 'payment_status', 'status', 'date_entered'],
            searchList:[],
        }
    },
     mounted() {
        this.searchList = searchArray;
        this.childMethod();
        this.lang = lang;
    },
    methods:{

        childMethod(){
            if(this.generic == true){
                this.$refs.loadGeneric.loadGenericView(this.metaList,this.columns,this.searchList);
            }
            
        }
    }
}
</script>