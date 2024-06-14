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
import breadcrumbs from "@/views/modules/Users/MenuList.vue";
import lang from "@/views/modules/Users/language/en";
import GenericDetail from "@/components/layout/shared/DetailView.vue";
import CustomDetail from "@/views/modules/Users/DetailView.vue";
import GenericMoreButton from "@/components/layout/shared/common/MoreButton.vue";
import CustomMoreButton from "@/views/modules/Users/MoreButton.vue";
//import DownloadAction from "@/components/layout/shared/download/Download.vue";

    export default {
        name: "detail-users",
        components: {
            breadcrumbs,
            GenericDetail,
            CustomDetail,
            CustomMoreButton,
            GenericMoreButton,
           // DownloadAction,
        },
        data() {
            return {
                generic:true,
                genericBtn:true,
                lang:[],
                metaList: [
                    {
                        name: 'col1',
                        items: [
                            {
                                name: 'first_name',
                                label: lang.LBL_FIRST_NAME,
                                link: false,
                                routePath: 'users'
                            },
                            {
                                name: 'last_name',
                                label: lang.LBL_LAST_NAME,
                                link: true,
                                routePath: 'users'
                            },
                            {
                                name: 'sex',
                                label: lang.LBL_USER_GENDER,
                            },
                        ]
                    },

                    {
                        name: 'col2',
                        items: [
                            {
                                name: 'user_name',
                                label: lang.LBL_USER_NAME,
                            },
                            {
                                name: 'email',
                                label: lang.LBL_EMAIL_ADDRESS,
                            },
                            {
                                name: 'phone_mobile',
                                label: lang.LBL_PHONE,
                                link: false,
                                routePath: ''
                            },
                        ]
                    },

                    {
                        name: 'col2',
                        items: [
                            {
                                name: 'status',
                                label: lang.LBL_USER_STATUS,
                            },
                            {
                                name: 'login_status',
                                label: lang.LBL_LOGIN_STATUS,
                            },
                            {
                                name: 'date_entered',
                                label: lang.LBL_CREATED_DATE,
                            },
                        ]
                    }




                ],
                moreBtn: [
                    {
                        id: 'edit',
                        path: 'users',
                        label: lang.LBL_ACTION_EDIT,
                        action:'edit',
                    },
                    {
                        id: 'delete',
                        path: 'users',
                        label: lang.LBL_ACTION_DELETE,
                        action:'delete',
                    },
                ],
                routePath: {
                    path: 'users',
                    detail: false
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
            this.childMethod();
            this.lang = lang;
            //this.showdowmload();
        },
        methods: {
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