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
import breadcrumbs from "@/views/modules/Users/MenuList.vue";
import lang from "@/views/modules/Users/language/en";
import GenericList from "@/components/layout/shared/ListView.vue";
import CustomList from "@/views/modules/Users/ListView.vue";
import searchArray from "@/views/modules/Users/metaview/metajs/SearchView.js";

export default {
    name: "new-users",
    components: {  breadcrumbs, GenericList,  CustomList, },
    data(){
        return{
            generic:true,
            metaList:[
                {
                    label: lang.LBL_FIRST_NAME,
                    link:true,
                    linkOtherModule:false,
                    moduleName:'Users',/// moduleName is required
                    routePath:'users',/// routePath is required at start of object
                    relatedModule:''
                },
                {
                    label: lang.LBL_LAST_NAME,
                    link:false,
                    linkOtherModule:false,
                    routePath:'users',
                    relatedModule:''
                },
                {
                    label: lang.LBL_USER_EMAIL,
                    link:true,
                    linkOtherModule:false,
                    routePath:'users',
                    relatedModule:''
                },
                {
                    label: lang.LBL_ROLE,
                    link:false,
                    linkOtherModule:false,
                    routePath:'',
                    relatedModule:''
                },
                {
                    label: lang.LBL_USER_STATUS,
                    link:false,
                    linkOtherModule:false,
                    routePath:'',
                    relatedModule:''
                },
            ],
            columns: ['first_name', 'last_name', 'email','user_role_name', 'status'],
             related_id:'parent_id',
            searchList:[],
        }
    },
    mounted() {
        this.searchList = searchArray;
        this.childMethod();
        this.lang = lang;
    },
    methods:{

        childMethod(){
            if(this.generic==true){
               this.$refs.loadGeneric.loadGenericView(this.metaList,this.columns,this.searchList);
            }
        }
    }
}

</script>



