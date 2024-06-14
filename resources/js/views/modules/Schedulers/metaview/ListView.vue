<template>
    <main>
        <breadcrumbs></breadcrumbs>
        <GenericList v-if="generic" ref="loadGeneric"></GenericList>
        <CustomList v-else></CustomList>
    </main>
</template>



<script>
import { ref } from "vue";
import breadcrumbs from "@/views/modules/Schedulers/MenuList.vue";
import lang from "@/views/modules/Schedulers/language/en";
import GenericList from "@/components/layout/shared/ListView.vue";
import CustomList from "@/views/modules/Schedulers/ListView.vue";
import searchArray from "@/views/modules/Schedulers/metaview/metajs/SearchView.js";

export default {
name: "new-categorys",
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
                    label:'Job Name',
                    link:true,
                    linkOtherModule:false,
                    moduleName:'Schedulers',/// moduleName is required
                    routePath:'schedulers'/// routePath is required at start of object folder name
                },
                {
                    label:'Job',
                    link:false,
                    linkOtherModule:false,
                    routePath:''
                },
                {
                    label:'Status',
                    link:false,
                    linkOtherModule:false,
                    routePath:''
                },
            ],
            columns: ['name','job', 'status'],
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



