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
import GenericList from "@/components/layout/shared/ListView.vue";
import CustomList from "@/views/modules/Categorys/ListView.vue";
import searchArray from "@/views/modules/Categorys/metaview/metajs/SearchView.js";
import breadcrumbs from "@/views/modules/Categorys/MenuList.vue";
import lang from "@/views/modules/Categorys/language/en.js";

export default {
    name:'category-list-view',
    components:{
        GenericList,
        CustomList,
        breadcrumbs,
    },
    data(){
        return {
            generic:true,
            metaList:[
                {
                    label:lang.LBL_CATEGORY_NAME,
                    link:true,
                    routePath:'categorys',/// routePath is required at start of object
                    relatedModule:''
                },
                {
                    label:lang.LBL_STATUS,
                    link:false,
                    routePath:'',
                    relatedModule:''
                },
                {
                    label:lang.LBL_DATE_ENTERED,
                    link:false,
                    routePath:'',
                    relatedModule:''
                },
            ],
            columns: ['name', 'status', 'date_entered'],
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
            if(this.generic == true){
                this.$refs.loadGeneric.loadGenericView(this.metaList,this.columns,this.searchList);
            }
            
        }
    }
}
</script>