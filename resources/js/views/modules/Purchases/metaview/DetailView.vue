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
        <CustomMoreButton v-else :record="record"></CustomMoreButton>

    </main>


</template>

<script>
    import { ref } from "vue";
    import GenericDetail from "@/components/layout/shared/DetailView.vue";
    import CustomDetail from "@/views/modules/Purchases/DetailView.vue";
    import breadcrumbs from "@/views/modules/Purchases/MenuList.vue";
    import lang from "@/views/modules/Purchases/language/en";
    import GenericMoreButton from "@/components/layout/shared/common/MoreButton.vue";
    import CustomMoreButton from "@/views/modules/Purchases/MoreButton.vue";

    export default {
        name: "detail-purchases",
        components: {
            breadcrumbs,
            GenericDetail,
            CustomDetail,
            CustomMoreButton,
            GenericMoreButton,
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
                        path: 'purchases',
                        label: lang.LBL_EDIT,
                        action: 'edit',
                    },
                    {
                        id: 'delete',
                        path: 'purchases',
                        label: lang.LBL_DELETE,
                        action: 'delete',
                    },

                ],
                routePath: {
                    path: 'purchases',
                    detail: false
                },
                downloadAction: false,
                dowlloadList: [
                    {
                        label: lang.LBL_DOWNLOAD_ONE,
                        action: "/purchases/generate-pdf",
                        module: "purchases",
                    },
                    {
                        label: lang.LBL_DOWNLOAD_TWO,
                        action: "",
                        module: "",
                    }
                ],
                record: null,
                status:"",
            }
        },
        mounted() {
            this.childMethod();
            this.lang = lang;
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
            updateInventory(record)
            {
                 const self = this;
                axios.post('modules/update_inventory',{'purchase_id':record}).then(function(response){
                    alert(response.data.message);
                    self.$router.push('/modules/purchases/');
                })
            }
        }
    }

</script>