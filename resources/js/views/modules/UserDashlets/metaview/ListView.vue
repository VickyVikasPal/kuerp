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
import breadcrumbs from "@/views/modules/UserDashlets/MenuList.vue";
import lang from "@/views/modules/UserDashlets/language/en";
import GenericList from "@/components/layout/shared/ListView.vue";
import CustomList from "@/views/modules/UserDashlets/ListView.vue";
import searchArray from "@/views/modules/UserDashlets/metaview/metajs/SearchView.js";

export default {
name: "list-userDsahlet",
components: {
    breadcrumbs,
    GenericList,
    CustomList,
    },
    data(){
        return{
            generic:true,
            metaList:[
                {
                    label:'Name',
                    link:false,
                    linkOtherModule:false,
                    moduleName:'UserDashlets',/// moduleName is required
                    routePath:'userdashlets'/// routePath is required at start of object
                },
                {
                    label:'UserType',
                    link:true,
                    linkOtherModule:false,
                    routePath:'userdashlets'/// routePath is required at start of object
                },
                {
                    label:'Table View',
                    link:false,
                    linkOtherModule:false,
                    routePath:'userdashlets'/// routePath is required at start of object
                },
                {
                    label:'Graph View',
                    link:false,
                    linkOtherModule:false,
                    routePath:'userdashlets'/// routePath is required at start of object
                },
                {
                    label:'Graph Type',
                    link:false,
                    linkOtherModule:false,
                    routePath:''
                },
            ],
            columns: ['name', 'user_type', 'table_view', 'graph_view', 'graph_type'],
            searchList:[],
        }
    },
    mounted() {
        this.childMethod();
        this.lang = lang;
        this.searchList = searchArray;
    },
    methods:{

        childMethod(){
            if(this.generic == true){
                this.$refs.loadGeneric.loadGenericView(this.metaList,this.columns,this.searchList);
            }
        }
    }
}

</script>



