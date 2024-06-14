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
    import GenericDetail from "@/components/layout/shared/DetailView.vue";
    import CustomDetail from "@/views/modules/ClientMasters/DetailView.vue";
    import breadcrumbs from "@/views/modules/ClientMasters/MenuList.vue";
    import lang from "@/views/modules/ClientMasters/language/en";
    import GenericMoreButton from "@/components/layout/shared/common/MoreButton.vue";
    import CustomMoreButton from "@/views/modules/ClientMasters/MoreButton.vue";

    export default {
        name: "detail-clientMasters",
        components: {
            breadcrumbs,
            GenericDetail,
            CustomDetail,
            CustomMoreButton,
            GenericMoreButton,
        },
        data() {
            return {
                generic: true,
                genericBtn:true,
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
                                name: 'firm_name',
                                label: lang.LBL_FIRM_NAME,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'contact_no',
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
                                name: 'client_email',
                                label: lang.LBL_EMAIL_ID,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'gst_status',
                                label: lang.LBL_GST_STATUS,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'gst_number',
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
                                name: 'address',
                                label: lang.LBL_ADDRESS,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'area',
                                label: lang.LBL_AREA,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'state',
                                label: lang.LBL_STATE,
                                link: false,
                                routePath: ''
                            },
                            {
                                name: 'pin_no',
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
                        path: 'clientmasters',
                        label: lang.LBL_EDIT,
                        action: 'edit',
                    },
                    {
                        id: 'delete',
                        path: 'clientmasters',
                        label: lang.LBL_DELETE,
                        action: 'delete',
                    },

                ],
                routePath: {
                    path: 'clientmasters',
                    detail: false
                },
                downloadAction: false,
                dowlloadList: [
                    {
                        label: lang.LBL_DOWNLOAD_ONE,
                        action: "/clientmasters/generate-pdf",
                        module: "clientmasters",
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
            this.childMethod();
            this.lang = lang;
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
        }
    }

</script>