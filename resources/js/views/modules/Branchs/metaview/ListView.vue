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
import breadcrumbs from "@/views/modules/Branchs/MenuList.vue";
import lang from "@/views/modules/Branchs/language/en";
import GenericList from "@/components/layout/shared/ListView.vue";
import CustomList from "@/views/modules/Branchs/ListView.vue";
import searchArray from "@/views/modules/Branchs/metaview/metajs/SearchView.js";

export default {
name: "list-branch",
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
                    label:lang.LBL_BRANCH_NAME,
                    link:true,
                    relatedModule:false,
                    routePath:'branchs'/// routePath is required at start of object folder name
                },
                {
                    label:lang.LBL_BRANCH_CODE,
                    link:true,
                    relatedModule:false,
                    routePath:'branchs'/// routePath is required at start of object folder name
                },
                {
                    label:lang.LBL_DEFAULT_BRANCH,
                    link:false,
                    relatedModule:false,
                    routePath:'',
                },
                {
                    label:lang.LBL_STATUS,
                    link:false,
                    relatedModule:false,
                    routePath:''
                },
               /*  {
                    label:'Created Date',
                    link:false,
                    linkOtherModule:false,
                    routePath:''
                }, */
            ],
            //columns: ['name', 'branch_code', 'default_branch', 'status', 'date_entered'],
            columns: ['name', 'branch_code', 'default_branch', 'status'],
            searchList:[],
        }
    },
    mounted() {
        this.childMethod();
        this.searchList = searchArray;
        this.lang = lang;
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



