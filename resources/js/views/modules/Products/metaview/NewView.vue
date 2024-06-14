<template>
<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
                    <breadcrumbs></breadcrumbs>
                </div>
                
            </div>
        </div>
    <GenericNew v-if="generic" ref="loadGeneric"></GenericNew>
    <CustomNew v-else></CustomNew>
    
</main>
</template>
<script>
import {ref} from 'vue'
import GenericNew from '@/components/layout/shared/NewView.vue';
import CustomNew from "@/views/modules/Products/NewView.vue";
import breadcrumbs from "@/views/modules/Products/MenuList.vue";
import lang from "@/views/modules/Products/language/en.js";
export default {
    name:'create-products',
    components:{
        GenericNew,
        CustomNew,
        breadcrumbs,
    },
    data() {
        return {
            generic:true,
            metaList:[
                {
                    type:'select_component',
                    name:'name',
                    label:lang.LBL_CATEGORY_NAME,
                    required:true,
                    linkComponent: 'category',
                    moduleName: 'Categorys',
                    parent_id:'parent_id',
                    parent_type:'parent_type',
                },
                {
                    type:'text',
                    name:'product_brand',
                    label:lang.LBL_BRAND_NAME,
                    required:true,
                },
                {
                    type:'text',
                    name:'product_code',
                    label:lang.LBL_PRODUCT_CODE,
                    required:true,
                },
                {
                    type:'text',
                    name:'name',
                    label:lang.LBL_PRODUCT_NAME,
                    required:true,
                },
                {
                    type:'text',
                    name:'product_qty',
                    label:lang.LBL_PRODUCT_QTY,
                    required:true,
                },
                {
                    type:'selectbox',
                    name:'product_unit',
                    label:lang.LBL_PRODUCT_UNIT,
                    selected:'Nos',
                    items:[
                        {value:'Nos'},
                        {value:'Ltr'},
                    ]
                    
                },
                {
                    type:'text',
                    name:'taxable_price',
                    label:lang.LBL_PRODUCT_UNIT_PRICE,
                    required:true,
                },
                {
                    type:'text',
                    name:'hsn_code',
                    label:lang.LBL_PRODUCT_HSN_CODE,
                    required:true,
                },
                {
                    type:'selectbox',
                    name:'tax_type',
                    label:lang.LBL_PRODUCT_TAX_TYPE,
                    selected:'5',
                    items:[
                        {value:'5'},
                        {value:'12'},
                        {value:'18'},
                        {value:'28'},
                    ]
                    
                },
                {
                    type:'selectbox',
                    name:'status',
                    label:lang.LBL_PRODUCT_STATUS,
                    selected:'Active',
                    items:[
                        {value:'Active'},
                        {value:'Deactive'},
                    ]
                    
                },
                {
                    type:'textarea',
                    name:'description',
                    label:lang.LBL_PRODUCT_DESCRIPTION,
                    required:true,
                },
            ],
            urls:'api/modules/products',
            
            routePath:{
                path:'products',
                detail:false
            },
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