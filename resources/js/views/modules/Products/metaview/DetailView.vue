<template>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
                    <breadcrumbs></breadcrumbs>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-4 text-end">
                    <DownloadAction v-if="downloadAction" ref="loaddownload"></DownloadAction>
                </div>
            </div>
        </div>

        <GenericDetail v-if="generic" ref="loadGeneric"></GenericDetail>
        <CustomDetail v-else></CustomDetail>

        <GenericMoreButton v-if="genericBtn" ref="loadgenericbtn"></GenericMoreButton>
        <CustomMoreButton v-else></CustomMoreButton>

    </main>
       

</template>

<script>
import { ref } from "vue";
import breadcrumbs from "@/views/modules/Products/MenuList.vue";
import lang from "@/views/modules/Products/language/en";
import GenericDetail from "@/components/layout/shared/DetailView.vue";
import CustomDetail from "@/views/modules/Products/DetailView.vue";
import GenericMoreButton from "@/components/layout/shared/common/MoreButton.vue";
import CustomMoreButton from "@/views/modules/Categorys/MoreButton.vue";
import DownloadAction from "@/components/layout/shared/download/Download.vue";

export default {
name: "detail-products",
components: {
        breadcrumbs,
        GenericDetail,
        CustomDetail,
        GenericMoreButton,
        CustomMoreButton,
        DownloadAction,
    },
    data(){
        return{
            generic:true,
            genericBtn:true,
            metaList:[
                {
                    name:'col1',
                    items:[
                        {
                            name:'category_name',
                            label:lang.LBL_CATEGORY_NAME,
                            link:false,
                            routePath:''
                        },
                         {
                            name:'name',
                            label:lang.LBL_PRODUCT_NAME,
                            link:false,
                            routePath:'products'
                        },
                        {
                            name:'product_qty',
                            label:lang.LBL_PRODUCT_QTY,
                            link:false,
                            routePath:'products',/// routePath is required at start of object
                        },
                        {
                            name:'product_brand',
                            label:lang.LBL_BRAND_NAME,
                            link:false,
                            routePath:'products',/// routePath is required at start of object
                        },
                    ]   
                },
                {
                    name:'col2',
                    items:[
                        {
                            name:'product_code',
                            label:lang.LBL_PRODUCT_CODE,
                            link:false,
                            routePath:''
                        },
                         {
                            name:'product_unit',
                            label:lang.LBL_PRODUCT_UNIT,
                            link:false,
                            routePath:'products'
                        },
                        {
                            name:'hsn_code',
                            label:lang.LBL_PRODUCT_HSN_CODE,
                            link:false,
                            routePath:'products',/// routePath is required at start of object
                        },
                    ]   
                },
                {
                    name:'col3',
                    items:[
                        {
                            name:'tax_type',
                            label:lang.LBL_PRODUCT_TAX_TYPE_RATE,
                            link:false,
                            routePath:''
                        },
                         {
                            name:'taxable_price',
                            label:lang.LBL_TAXABLE_PRICE,
                            link:false,
                            routePath:'products'
                        },
                        {
                            name:'igst',
                            label:lang.LBL_TOTAL_TAX,
                            link:false,
                            routePath:'products',/// routePath is required at start of object
                        },
                    ]   
                },
                {
                    name:'col4',
                    items:[
                        {
                            name:'unit_price',
                            label:lang.LBL_TOTAL_UNIT_PRICE,
                            link:false,
                            routePath:''
                        },
                         {
                            name:'status',
                            label:lang.LBL_STATUS,
                            link:false,
                            routePath:'products'
                        },
                        {
                            name:'description',
                            label:lang.LBL_PRODUCT_DESCRIPTION,
                            link:false,
                            routePath:'products'
                        },
                        {
                            name:'date_entered',
                            label:lang.LBL_CREATED_DATE,
                            link:false,
                            routePath:'products',/// routePath is required at start of object
                        },
                    ]   
                },      
                          
            ],
            moreBtn: [
                {
                    id: 'edit',
                    path: 'products',
                    label: lang.LBL_EDIT,
                    action: 'edit',
                },
                {
                    id: 'delete',
                    path: 'products',
                    label: lang.LBL_DELETE,
                    action: 'delete',
                },

            ],
            routePath: {
                path: 'products',
                detail: false
            },
            downloadAction: true,
            dowlloadList: [
                {
                    label: lang.LBL_DOWNLOAD_ONE,
                    action: "/products/generate-pdf",
                    module: "Products",
                },
                {
                    label: lang.LBL_DOWNLOAD_TWO,
                    action: "",
                    module: "",
                }
            ],
            record: null,
        }
    },
    mounted() {
        this.lang = lang; 
        this.childMethod();
        this.showdowmload();
    },
    methods:{
        childMethod(){
            if(this.generic == true){
                this.$refs.loadGeneric.loadGenericView(this.metaList, this.routePath);
            }
            if(this.genericBtn == true){
                this.$refs.loadgenericbtn.loadGenericBtn(this.moreBtn);
            }
        },
        showdowmload(){
            const self = this;
            //console.log(this.dowlloadList);
            if(self.downloadAction == true){
                this.$refs.loaddownload.loadDownloadView(self.dowlloadList);
            }
            
        }
    }
}

</script>



