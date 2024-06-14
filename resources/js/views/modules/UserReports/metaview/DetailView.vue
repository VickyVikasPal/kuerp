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
import breadcrumbs from "@/views/modules/UserReports/MenuList.vue";
import lang from "@/views/modules/UserReports/language/en";
import GenericDetail from "@/components/layout/shared/DetailView.vue";
import CustomDetail from "@/views/modules/UserReports/DetailView.vue";
import GenericMoreButton from "@/components/layout/shared/common/MoreButton.vue";
import CustomMoreButton from "@/views/modules/UserReports/MoreButton.vue";

export default {
name: "detail-userReport",
components: {
        breadcrumbs,
        GenericDetail,
        CustomDetail,
        GenericMoreButton,
        CustomMoreButton,
    },
    data(){
        return{
            generic:false,
            genericBtn:false,
            metaList:[
                {
                    name:'col1',
                    items:[
                        {
                            name:'id',
                            label:'Id',
                            link:false,
                            routePath:'users'
                        },
                        {
                            name:'username',
                            label:'User Name',
                            link:false,
                            routePath:'',
                            is_image:false,
                        },
                        {
                            name:'email',
                            label:'Email',
                            link:false,
                            routePath:'users'
                        },
                    ]   
                },
                       
               
              
                {
                    name:'col2',
                    items:[
                        {
                            name:'status',
                            label:'Status',
                            link:false,
                            routePath:''
                        },
                        {
                            name:'created_at',
                            label:'Date Created',
                            link:false,
                            routePath:''
                        },
                        {
                            name:'updated_at',
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
                path:'users',
                label:'Edit',
                },
                {
                id:'delete',
                path:'users',
                label:'Delete',
                },
            ],
            routePath:{
                path:'users',
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
                this.$refs.loadGeneric.loadGenericView(this.metaList,this.moreBtn,this.routePath);
            }
        }
    }
}

</script>



