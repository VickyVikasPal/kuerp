<template>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
                    <breadcrumbs></breadcrumbs>
                </div>
            </div>
        </div>
        <GenericList v-if="generic" ref="loadGeneric"></GenericList>
        <CustomList v-else></CustomList>
    </main>
</template>

<script>
    import { ref } from "vue";
    import breadcrumbs from "@/views/modules/CountryLists/MenuList.vue";
    import lang from "@/views/modules/CountryLists/language/en";
    import GenericList from "@/components/layout/shared/ListView.vue";
    import CustomList from "@/views/modules/CountryLists/ListView.vue";

    export default {
        name: "new-categorys",
        components: {
            breadcrumbs,
            GenericList,
            CustomList,
        },
        data() {
            return {
                generic: true,
                metaList: [
                    {
                        label: lang.LBL_COUNTRY_NAME,
                        link: true,
                        linkOtherModule:false,
                        moduleName: 'CountryLists',
                        routePath: 'countrylists'
                    },
                    {
                        label: lang.LBL_ISD_CODE,
                        link: false,
                        linkOtherModule:false,
                    },
                    {
                        label: lang.LBL_STATUS,
                        link: false,
                        linkOtherModule:false,
                    },
                   
                ],
                columns: ['name', 'isd_code', 'status'],
            }
        },
        mounted() {
            this.childMethod();
            
        },
        methods: {
            childMethod() {
                if (this.generic == true) {
                    this.$refs.loadGeneric.loadGenericView(this.metaList, this.columns);
                }
            }
        }
    }
</script>