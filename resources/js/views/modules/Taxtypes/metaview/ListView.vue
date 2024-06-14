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
import breadcrumbs from "@/views/modules/Taxtypes/MenuList.vue";
import lang from "@/views/modules/Taxtypes/language/en";
import GenericList from "@/components/layout/shared/ListView.vue";
import CustomList from "@/views/modules/Taxtypes/ListView.vue";

export default {
name: "new-taxtypes",
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
                    label: lang.LBL_TAX_NAME,
                    link:false,
                    linkOtherModule:false,
                    moduleName:'Taxtypes',/// moduleName is required
                    routePath:'taxtypes'/// routePath is required at start of object
                },
                {
                    label: lang.LBL_TAX_PERCENTAGE,
                    link:true,
                    linkOtherModule:false,
                    routePath:'taxtypes'/// routePath is required at start of object
                },
                {
                    label: lang.LBL_STATUS,
                    link:false,
                    linkOtherModule:false,
                    routePath:''
                },
                {
                    label: lang.LBL_DESCRIPTION,
                    link:false,
                    linkOtherModule:false,
                    routePath:''
                },
            ],
            columns: ['name', 'tax', 'status', 'description'],

        }
    },
    mounted() {
        this.childMethod();
        this.$emit('MetaView','Awesome')
    },
    methods:{
        childMethod(){
            if(this.generic == true){
                this.$refs.loadGeneric.loadGenericView(this.metaList,this.columns);
            }
            
        }
    }
}

</script>



