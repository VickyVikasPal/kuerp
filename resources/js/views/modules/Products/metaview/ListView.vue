<template>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
                    <breadcrumbs></breadcrumbs>
                </div>
                
            </div>
        </div>
        <GenericList v-if="genericView" ref="loadGeneric"></GenericList>
        <CustomList v-else></CustomList>
    </main>
</template>
<script>
import { ref } from "vue";
import GenericList from "@/components/layout/shared/ListView.vue";
import CustomList from "@/views/modules/Products/ListView.vue";
import searchArray from "@/views/modules/Products/metaview/metajs/SearchView.js";
import breadcrumbs from "@/views/modules/Products/MenuList.vue";
import lang from "@/views/modules/Products/language/en.js";

export default {
    name:'list-products',
    components:{
        GenericList,
        CustomList,
        breadcrumbs,
    },
    data(){
        return {
            genericView:true,
            metaList:[
                {
                    label:lang.LBL_CATEGORY_NAME,
                    link:true,
                    routePath:'products',/// routePath is required at start of object
                    relatedModule:'categorys'                    
                },
                {
                    label:lang.LBL_PRODUCT_NAME,
                    link:true,
                    routePath:'products',/// routePath is required at start of object
                    relatedModule:''
                },
                {
                    label:lang.LBL_BRAND_NAME,
                    link:false,
                    routePath:'products',/// routePath is required at start of object
                    relatedModule:''
                },
                {
                    label:lang.LBL_PRODUCT_UNITPRICE,
                    link:false,
                    routePath:'products',/// routePath is required at start of object
                    relatedModule:''
                },
                {
                    label:'lang.LBL_STATUS',
                    link:false,
                    routePath:'',
                    relatedModule:''
                },
                {
                    label:lang.LBL_CREATED_DATE,
                    link:false,
                    routePath:'',
                    relatedModule:''
                },
            ],
            columns: ['category_name','name', 'product_brand', 'taxable_price', 'status', 'date_entered'],
            related_id:'parent_id',
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
          
            if(this.genericView == true){
                 this.$refs.loadGeneric.loadGenericView(this.metaList, this.columns, this.searchList, this.related_id);
            }
        }
    }
}
</script>