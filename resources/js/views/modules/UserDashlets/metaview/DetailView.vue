<template>
    <main>
          <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
                     <breadcrumbs></breadcrumbs>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-4 text-end">
                    <!-- <DownloadAction v-if="downloadAction" ref="loaddownload"></DownloadAction> -->
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
import breadcrumbs from "@/views/modules/UserDashlets/MenuList.vue";
import lang from "@/views/modules/UserDashlets/language/en";
import GenericDetail from "@/components/layout/shared/DetailView.vue";
import CustomDetail from "@/views/modules/UserDashlets/DetailView.vue";
import GenericMoreButton from "@/components/layout/shared/common/MoreButton.vue";
import CustomMoreButton from "@/views/modules/Users/MoreButton.vue";
//import DownloadAction from "@/components/layout/shared/download/Download.vue";

export default {
name: "user-dashlets-details",
components: {
        breadcrumbs,
        GenericDetail,
        CustomDetail,
        CustomMoreButton,
        GenericMoreButton,
       // DownloadAction,
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
                            name:'name',
                            label:'Module Name',
                            link:false,
                            routePath:'userdashlets',
                            is_image:false,
                        },
                        {
                            name:'user_type',
                            label:'Tax',
                            link:false,
                            routePath:'userdashlets'
                        },
                        {
                            name:'status',
                            label:'Status',
                            link:false,
                            routePath:''
                        },
                        {
                            name:'graph_view',
                            label:'Graph Status',
                            link:false,
                            routePath:''
                        },
                    ]   
                },
                       
               
              
                {
                    name:'col2',
                    items:[
                        {
                            name:'table_view',
                            label:'Table Status',
                            link:false,
                            routePath:''
                        },
                        {
                            name:'date_entered',
                            label:'Date Created',
                            link:false,
                            routePath:''
                        },
                        {
                            name:'date_modified',
                            label:'Date Modified',
                            link:false,
                            routePath:''
                        },
                    ]
                }
                        
               
                 
                               
            ],
            moreBtn:[
                {
                id:'edit',
                path:'userdashlets',
                label:'Edit',
                action:'edit',
                },
                {
                id:'delete',
                path:'userdashlets',
                label:'Delete',
                action:'delete',
                },
            ],
            routePath:{
                path:'userdashlets',
                detail:false
            },
            // downloadAction:false,
            // dowlloadList:[
            //     {
            //         label: lang.LBL_DOWNLOAD_ONE,
            //         action:"",
            //         module:"",
            //     },
            //     {
            //         label: lang.LBL_DOWNLOAD_TWO,
            //         action:"",
            //         module:"",
            //     }
            // ] 
        }
    },
    mounted() {
        this.childMethod()
        this.lang = lang;
        //this.showdowmload();
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
            // showdowmload(){
            //     const self = this;
            //     console.log(this.dowlloadList);
            //     if(self.downloadAction == true){
            //         this.$refs.loaddownload.loadDownloadView(self.dowlloadList);
            //     }
            // }
    }
}

</script>



