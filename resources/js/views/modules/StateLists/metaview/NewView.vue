<template>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
                    <breadcrumbs></breadcrumbs>
                </div>

            </div>
        </div>
        <GenericNew v-if="generic" ref="loadGeneric" :urls="urls"></GenericNew>
        <CustomNew v-else></CustomNew>
    </main>
</template>

<script>
    import { ref } from "vue";
    import breadcrumbs from "@/views/modules/StateLists/MenuList.vue";
    import lang from "@/views/modules/StateLists/language/en";
    import GenericNew from "@/components/layout/shared/NewView.vue";
    import CustomNew from "@/views/modules/StateLists/NewView.vue";

    export default {
        name: "new-state-list-new",
        components: {
            breadcrumbs,
            GenericNew,
            CustomNew,
        },
        data() {
            return {
                generic: true,
                metaList: [
                    {
                        type: 'selectcomponent',
                        name: 'countrylist_name',
                        label: lang.LBL_COUNTRY_NAME,
                        required: true,
                        linkComponent: 'countrylist',
                        moduleName: 'CountryLists',
                        parent_id: 'parent_id',
                        parent_type: 'parent_type',
                    },
                    {
                        type: 'text',
                        name: 'name',
                        label: lang.LBL_STATE_NAME,
                        required: true
                    },
                   {
                        type:'selectbox',
                        name:'status',
                        label: lang.LBL_STATUS,
                        items:[
                            {value: 'Active'},
                            {value: 'InActive'},
                        ],
                        required: false
                    },
                ],
                urls: 'api/modules/statelists',

                routePath: {
                    path: 'statelists',
                    detail: false
                }
            }
        },
        mounted() {
            this.childMethod()
        },
        methods: {
            childMethod() {
                if (this.generic == true) {
                    this.$refs.loadGeneric.loadGenericView(this.metaList, this.routePath);
                }
            }
        },
    }
</script>