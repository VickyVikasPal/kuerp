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

      
        <GenericDetail v-if="generic" ref="loadGeneric"> </GenericDetail>
        <CustomDetail v-else></CustomDetail>
        <!-- <div>
            <a href="/branchs/generate-pdf" onclick="window.open('/branchs/generate-pdf', 
            'newwindow', 'width=500,height=500'); return false;"
                target="_blank">{{ $t('Download PDF') }}</a>
        </div> -->
        <GenericMoreButton v-if="genericBtn" ref="loadgenericbtn"></GenericMoreButton>
        <CustomMoreButton v-else></CustomMoreButton>

    </main>
</template>

<script>
    import { ref } from "vue";
    import breadcrumbs from "@/views/modules/Branchs/MenuList.vue";
    import lang from "@/views/modules/Branchs/language/en";
    import GenericDetail from "@/components/layout/shared/DetailView.vue";
    import CustomDetail from "@/views/modules/Branchs/DetailView.vue";
    import GenericMoreButton from "@/components/layout/shared/common/MoreButton.vue";
    import CustomMoreButton from "@/views/modules/Branchs/MoreButton.vue";
    import DownloadAction from "@/components/layout/shared/download/Download.vue";

    export default {
        name: "detail-branch",
        components: {
            breadcrumbs,
            GenericDetail,
            CustomDetail,
            CustomMoreButton,
            GenericMoreButton,
            DownloadAction
        },
        data() {
            return {
                generic: true,
                genericBtn:true,
                lang: [],
                metaList: [
                    {
                        name: 'col1',
                        items: [
                            {
                                name: 'name',
                                label: lang.LBL_BRANCH_NAME,
                                link: false,
                            },
                            {
                                name: 'branch_code',
                                label: lang.LBL_BRANCH_CODE,
                                link: true,
                            },
                            {
                                name: 'default_branch',
                                label: lang.LBL_DEFAULT_BRANCH,
                                link: false,
                                routePath: '',
                                checkboxtype: true
                            },
                        ]
                    },
                    {
                        name: 'col2',
                        items: [
                            {
                                name: 'ip_address',
                                label: lang.LBL_IPADDRESS,
                                link: false,
                            },
                            {
                                name: 'upload_path',
                                label: lang.LBL_UPLOAD_DIR,
                                link: false,
                            },
                            {
                                name: 'status',
                                label: lang.LBL_STATUS,
                                link: false,
                            },
                        ]
                    },
                    {
                        name: 'col3',
                        items: [
                            {
                                name: 'for_mobileapp',
                                label: lang.LBL_SHOW_MOBILE_APP,
                                checkboxtype: true
                            },
                            {
                                name: 'description',
                                label: lang.LBL_DESCRIPTION,
                                link: false,
                            },
                        ]
                    },

                    {
                        name: 'col4',
                        items: [
                            {
                                name: 'date_entered',
                                label: lang.LBL_CREATE_DATE,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'date_modified',
                                label: lang.LBL_MODIFIED_DATE,
                                link: false,
                                routePath: ''
                            },
                        ]
                    }
                ],
                moreBtn: [
                    {
                        id: 'edit',
                        path: 'branchs',
                        label: lang.LBL_EDIT,
                        action:'edit',
                    },
                    {
                        id: 'delete',
                        path: 'branchs',
                        label: lang.LBL_DELETE,
                        action:'delete',
                    },
                    
                ],
                routePath: {
                    path: 'branchs',
                    detail: false
                },
                 
                downloadAction:true,
                dowlloadList:[
                    {
                        label: lang.LBL_DOWNLOAD_ONE,
                        action:"/branchs/generate-pdf",
                        module:"Branch",
                    },
                    {
                        label: lang.LBL_DOWNLOAD_TWO,
                        action:"",
                        module:"",
                    }
                ],
                record:null,
            }
        },
        mounted() {
            this.childMethod();
            this.lang = lang;
            this.showdowmload();
        },
        methods: {
            childMethod() {
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