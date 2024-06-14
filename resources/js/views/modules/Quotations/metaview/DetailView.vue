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
        <CustomDetail v-else  ref="loadLoader"></CustomDetail>

        <GenericMoreButton v-if="genericBtn" ref="loadgenericbtn"></GenericMoreButton>
        <CustomMoreButton v-else :record="record" @event="handler"></CustomMoreButton>

    </main>


</template>

<script>
    import { ref } from "vue";
    import GenericDetail from "@/components/layout/shared/DetailView.vue";
    import CustomDetail from "@/views/modules/Quotations/DetailView.vue";
    import breadcrumbs from "@/views/modules/Quotations/MenuList.vue";
    import lang from "@/views/modules/Quotations/language/en";
    import GenericMoreButton from "@/components/layout/shared/common/MoreButton.vue";
    import CustomMoreButton from "@/views/modules/Quotations/MoreButton.vue";
    import DownloadAction from "@/components/layout/shared/download/Download.vue";


    export default {
        name: "detail-quotations",
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
                generic: false,
                genericBtn:false,
                metaList: [
                    {
                        name: 'col1',
                        items: [
                            {
                                name: 'name',
                                label: lang.LBL_CUSTOMER_NAME,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'name',
                                label: lang.LBL_FIRM_NAME,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'name',
                                label: lang.LBL_CONTACT_NO,
                                link: false,
                                routePath: ''
                            },
                        ]
                    },
                    {
                        name: 'col2',
                        items: [
                            {
                                name: 'name',
                                label: lang.LBL_EMAIL_ID,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'name',
                                label: lang.LBL_GST_STATUS,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'name',
                                label: lang.LBL_GST_NUMBER,
                                link: false,
                                routePath: ''
                            },
                        ]
                    },
                    {
                        name: 'col3',
                        items: [
                            {
                                name: 'name',
                                label: lang.LBL_ADDRESS,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'name',
                                label: lang.LBL_AREA,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'name',
                                label: lang.LBL_STATE,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'name',
                                label: lang.LBL_PIN,
                                link: false,
                                routePath: ''
                            },
                        ]
                    },
                    {
                        name: 'col4',
                        items: [
                            {
                                name: 'status',
                                label: lang.LBL_STATUS,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'date_entered',
                                label: lang.LBL_DATE_ENTERED,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'date_entered',
                                label: lang.LBL_DATE_MODIFY,
                                link: false,
                                routePath: ''
                            },
                        ]
                    },


                ],
               moreBtn: [
                    {
                        id: 'edit',
                        path: 'quotations',
                        label: lang.LBL_EDIT,
                        action: 'edit',
                    },
                    {
                        id: 'delete',
                        path: 'quotations',
                        label: lang.LBL_DELETE,
                        action: 'delete',
                    },

                ],
                routePath: {
                    path: 'quotations',
                    detail: false
                },
                downloadAction: true,
                downloadList: [
                    {
                        label: lang.LBL_DOWNLOAD_ONE,
                        //action: "/modules/quotations/PdfView",
                        action: "/quotations/generate-pdf",
                        module: "quotations",
                    },
                ],
                record: null,
                status:"",
            }
        },
        mounted() {
            this.childMethod();
            this.lang = lang;
            this.showdowmload();
            this.record = this.$route.params.id;
        },
        methods: {
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
                if(self.downloadAction == true){
                    this.$refs.loaddownload.loadDownloadView(self.downloadList);
                }                
            },
            handler(params) {
            if(params == true){
                this.$refs.loadLoader.startLoader(true);
                }
                else{
                this.$refs.loadLoader.startLoader(false);
                }
            }
        }
    }

</script>