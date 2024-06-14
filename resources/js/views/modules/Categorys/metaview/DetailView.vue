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
    import GenericDetail from "@/components/layout/shared/DetailView.vue";
    import CustomDetail from "@/views/modules/Categorys/DetailView.vue";
    import breadcrumbs from "@/views/modules/Categorys/MenuList.vue";
    import lang from "@/views/modules/Categorys/language/en";
    import GenericMoreButton from "@/components/layout/shared/common/MoreButton.vue";
    import CustomMoreButton from "@/views/modules/Categorys/MoreButton.vue";

    export default {
        name: "detail-category",
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
                                label: lang.LBL_CATEGORY_NAME,
                                link: false,
                                routePath: 'categorys'
                            },
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
                        ]
                    },


                ],
               moreBtn: [
                    {
                        id: 'edit',
                        path: 'categorys',
                        label: lang.LBL_EDIT,
                        action: 'edit',
                    },
                    {
                        id: 'delete',
                        path: 'categorys',
                        label: lang.LBL_DELETE,
                        action: 'delete',
                    },

                ],
                routePath: {
                    path: 'categorys',
                    detail: false
                },
                downloadAction: false,
                dowlloadList: [
                    {
                        label: lang.LBL_DOWNLOAD_ONE,
                        action: "/categorys/generate-pdf",
                        module: "Categorys",
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