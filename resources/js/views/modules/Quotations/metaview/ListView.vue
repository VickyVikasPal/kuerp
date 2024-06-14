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
import CustomList from "@/views/modules/Quotations/ListView.vue";
import searchArray from "@/views/modules/Quotations/metaview/metajs/SearchView.js";
import breadcrumbs from "@/views/modules/Quotations/MenuList.vue";
import lang from "@/views/modules/Quotations/language/en.js";

export default {
    name:'list-quotations',
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
                    label:lang.LBL_QUOTATION_NO,
                    link:true,
                    routePath:'quotations',/// routePath is required at start of object
                    relatedModule:''
                },
                {
                    label:lang.LBL_CUSTOMER_NAME,
                    link:true,
                    routePath:'quotations',/// routePath is required at start of object
                    relatedModule:''
                },
                {
                    label:lang.LBL_DELIVERY_NO,
                    link:false,
                    routePath:'',
                    relatedModule:''
                },
                {
                    label:lang.LBL_INVOICE_NO,
                    link:true,
                    routePath:'quotations',/// routePath is required at start of object
                    relatedModule:''
                },
                {
                    label:lang.LBL_QUOTATION_AMOUNT,
                    link:true,
                    routePath:'quotations',/// routePath is required at start of object
                    relatedModule:''
                },
                {
                    label:lang.LBL_STATUS,
                    link:false,
                    routePath:'',
                    relatedModule:''
                },
                {
                    label:lang.LBL_QUOTATION_DATE,
                    link:false,
                    routePath:'',
                    relatedModule:''
                },
            ],
            columns: ['quotation_no', 'firm_name', 'delivery_no', 'invoice_no', 'grand_total', 'status', 'quotation_date'],
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