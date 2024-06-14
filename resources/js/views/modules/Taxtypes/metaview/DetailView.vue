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
import breadcrumbs from "@/views/modules/Taxtypes/MenuList.vue";
import lang from "@/views/modules/Taxtypes/language/en";
import GenericDetail from "@/components/layout/shared/DetailView.vue";
import CustomDetail from "@/views/modules/Taxtypes/DetailView.vue";
import GenericMoreButton from "@/components/layout/shared/common/MoreButton.vue";
import CustomMoreButton from "@/views/modules/Taxtypes/MoreButton.vue";
import DownloadAction from "@/components/layout/shared/download/Download.vue";

export default {
name: "new-product",
components: {
        breadcrumbs,
        GenericDetail,
        CustomDetail,
        CustomMoreButton,
        GenericMoreButton,
        DownloadAction,
    },
    data(){
        return{
            generic:true,
            genericBtn:true,
            lang:[],
            metaList:[
                {
                    name:'col1',
                    items:[
                        {
                            name:'name',
                            label: lang.LBL_TAXTYPE_NAME,
                            link:false,
                            routePath:'',
                            is_image:false,
                        },
                        {
                            name:'tax',
                            label: lang.LBL_TAX_PERCENTAGE,
                            link:false,
                            routePath:'taxtypes'
                        },
                        {
                            name:'status',
                            label: lang.LBL_STATUS,
                            link:false,
                            routePath:''
                        },
                    ]   
                },
                       
               
              
                {
                    name:'col2',
                    items:[
                        {
                            name:'description',
                            label: lang.LBL_DESCRIPTION,
                            link:false,
                            routePath:''
                        },
                        {
                            name:'created_at',
                            label: lang.LBL_CREATED_DATE,
                            link:false,
                            routePath:''
                        },
                        {
                            name:'updated_at',
                            label: lang.LBL_MODIFIED_DATE,
                            link:false,
                            routePath:''
                        },
                    ]
                }
                        
               
                 
                               
            ],
            moreBtn:[
                {
                    id:'edit',
                    path:'taxtypes',
                    label: lang.LBL_ACTION_EDIT,
                    action:'edit',
                },
                {
                    id:'delete',
                    path:'taxtypes',
                    label: lang.LBL_ACTION_DELETE,
                    action:'delete',
                },
            ],
            routePath:{
                path:'taxtypes',
                detail:false
            },
            downloadAction:false,
            dowlloadList:[
                {
                    label: lang.LBL_DOWNLOAD_ONE,
                    action:"",
                    module:"",
                },
                {
                    label: lang.LBL_DOWNLOAD_TWO,
                    action:"",
                    module:"",
                }
            ]
        }
    },
    mounted() {
        this.childMethod();
        this.lang = lang;
        this.showdowmload();
    },
    methods:{
       childMethod(){
            if(this.generic == true){
                this.$refs.loadGeneric.loadGenericView(this.metaList,this.routePath);
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



