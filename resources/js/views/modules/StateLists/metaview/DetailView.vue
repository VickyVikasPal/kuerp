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
        <GenericMoreButton v-if="genericBtn" ref="loadgenericbtn"></GenericMoreButton>
        <CustomMoreButton v-else></CustomMoreButton>

    </main>
</template>

<script>
    import { ref } from "vue";
    import breadcrumbs from "@/views/modules/StateLists/MenuList.vue";
    import lang from "@/views/modules/StateLists/language/en";
    import GenericDetail from "@/components/layout/shared/DetailView.vue";
    import CustomDetail from "@/views/modules/StateLists/DetailView.vue";
    import GenericMoreButton from "@/components/layout/shared/common/MoreButton.vue";
    import CustomMoreButton from "@/views/modules/StateLists/MoreButton.vue";
    import DownloadAction from "@/components/layout/shared/download/Download.vue";

    export default {
        name: "new-state-list-detail",
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
                genericBtn: true,
                lang: [],
                metaList: [
                   
                    {
                        name: 'col1',
                        items: [
                            {
                                name: 'countrylist_name',
                                label: lang.LBL_COUNTRY_NAME,
                                link:true,
                                routePath:'countrylists',
                                related_id:'parent_id',
                            },
                            {
                                name: 'name',
                                label: lang.LBL_STATE_NAME,
                                link: true,
                            },
                            {
                                name: 'status',
                                label: lang.LBL_STATUS,
                                link: true,
                            },
                        ]
                    },
                    {
                        name: 'col4',
                        items: [
                            {
                                name: 'date_entered',
                                label: lang.LBL_ENTERED,
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
                        path: 'statelists',
                        label: lang.LBL_EDIT,
                        action: 'edit',
                    },
                    {
                        id: 'delete',
                        path: 'statelists',
                        label: lang.LBL_DELETE,
                        action: 'delete',
                    },

                ],
                routePath: {
                    path: 'statelists',
                    detail: false
                },
                downloadAction: false,
                dowlloadList: [
                    {
                        label: lang.LBL_DOWNLOAD_ONE,
                        action: "/statelists/generate-pdf",
                        module: "StateLists",
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
            this.showdowmload();
        },
        methods: {
            childMethod() {
                if (this.generic == true) {
                    this.$refs.loadGeneric.loadGenericView(this.metaList, this.routePath);
                }
                if (this.genericBtn == true) {
                    this.$refs.loadgenericbtn.loadGenericBtn(this.moreBtn);
                }
            },
            showdowmload() {
                const self = this;
                if (self.downloadAction == true) {
                    this.$refs.loaddownload.loadDownloadView(self.dowlloadList);
                }
            }
        }
    }

</script>