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
    import breadcrumbs from "@/views/modules/CountryLists/MenuList.vue";
    import lang from "@/views/modules/CountryLists/language/en";
    import GenericDetail from "@/components/layout/shared/DetailView.vue";
    import CustomDetail from "@/views/modules/CountryLists/DetailView.vue";
    import GenericMoreButton from "@/components/layout/shared/common/MoreButton.vue";
    import CustomMoreButton from "@/views/modules/CountryLists/MoreButton.vue";
    import DownloadAction from "@/components/layout/shared/download/Download.vue";

    export default {
        name: "new-country-lists",
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
                                name: 'name',
                                label: lang.LBL_COUNTRY_NAME,
                                link: false,
                            },
                            {
                                name: 'isd_code',
                                label: lang.LBL_ISD_CODE,
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
                        name: 'col2',
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
                        path: 'countrylists',
                        label: lang.LBL_EDIT,
                        action: 'edit',
                    },
                    {
                        id: 'delete',
                        path: 'countrylists',
                        label: lang.LBL_DELETE,
                        action: 'delete',
                    },

                ],
                routePath: {
                    path: 'countrylists',
                    detail: false
                },
                linkModule:[
                    {
                        moduleName:'StateLists',
                        showSubpanel:true
                    },
                    {
                        moduleName:'Categorys',
                        showSubpanel:true
                    }
                ],
                downloadAction: false,
                dowlloadList: [
                    {
                        label: lang.LBL_DOWNLOAD_ONE,
                        action: "/countrylists/generate-pdf",
                        module: "CountryLists",
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
                    this.$refs.loadGeneric.loadGenericView(this.metaList, this.routePath, this.linkModule);
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