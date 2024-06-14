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
import breadcrumbs from "@/views/modules/UserRoles/MenuList.vue";
import lang from "@/views/modules/UserRoles/language/en";
import GenericList from "@/components/layout/shared/ListView.vue";
import CustomList from "@/views/modules/UserRoles/ListView.vue";
import searchArray from "@/views/modules/UserRoles/metaview/metajs/SearchView.js";
    export default {
        name: "list-User-Role",
        
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
                        label: lang.LBL_NAME,
                        link: true,
                        relatedModule:false,
                        moduleName: 'UserRoles',/// moduleName is required
                        routePath: 'userroles'/// routePath is required at start of object
                    },
                    {
                        label: lang.LBL_STATUS,
                        link: false,
                        relatedModule:false,
                        moduleName: 'UserRoles',/// moduleName is required
                        routePath: 'userroles'/// routePath is required at start of object
                    },
                ],
                columns: ['name','status'],
                searchList:[],
            }
        },
        mounted() {
            this.childMethod();
            this.searchList = searchArray;
            this.lang = lang;
        },
        methods: {
            childMethod() {
                if (this.generic == true) {
                    this.$refs.loadGeneric.loadGenericView(this.metaList, this.columns,this.searchList);
                }
            }
        }
    }

</script>