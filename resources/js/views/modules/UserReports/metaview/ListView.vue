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
import breadcrumbs from "@/views/modules/UserReports/MenuList.vue";
import lang from "@/views/modules/UserReports/language/en";
import GenericList from "@/components/layout/shared/ListView.vue";
import CustomList from "@/views/modules/UserReports/ListView.vue";
import searchArray from "@/views/modules/UserReports/metaview/metajs/SearchView.js";

export default {
name: "list-userReport",
components: {
    breadcrumbs,
    GenericList,
    CustomList,
    },
    data(){
        return{
            generic:false,
            metaList:[
                {
                    label:'User Name',
                    link:false,
                    linkOtherModule:false,
                    moduleName:'UserRole',/// moduleName is required
                    routePath:'users'/// routePath is required at start of object
                },
                {
                    label:'User Email',
                    link:true,
                    linkOtherModule:false,
                    routePath:'users'/// routePath is required at start of object
                },
                {
                    label:'User Status',
                    link:false,
                    linkOtherModule:false,
                    routePath:''
                },
                {
                    label:'User Role',
                    link:false,
                    linkOtherModule:false,
                    routePath:''
                },
            ],
            columns: ['username', 'email', 'status', 'user_role'],
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
                 this.$refs.loadGeneric.loadGenericView(this.metaList,this.columns, this.searchList);
            }
        }
    }
}

</script>



