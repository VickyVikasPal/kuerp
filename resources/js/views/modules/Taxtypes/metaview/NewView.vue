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
import breadcrumbs from "@/views/modules/Taxtypes/MenuList.vue";
import lang from "@/views/modules/Taxtypes/language/en";
import GenericNew from "@/components/layout/shared/NewView.vue";
import CustomNew from "@/views/modules/Taxtypes/NewView.vue";

export default {
name: "new-product",
components: {
        breadcrumbs, 
        GenericNew,
        CustomNew,
    },
    data(){
        return {
            generic:true,
            metaList:[
                
                {
                    type:'text',
                    name:'name',
                    label: lang.LBL_TAXTYPE_NAME,
                    required: true
                },
                {
                    type:'text',
                    name:'tax',
                    label: lang.LBL_TAX_RATE,
                    required: true
                },
                {
                    type:'selectbox',
                    name:'status',
                    label: lang.LBL_STATUS,
                    items:[
                        {value: 'Active'},
                        {value: 'Inactive'},
                    ],
                    required: true
                },                
               {
                    type:'textarea',
                    name:'description',
                    label: lang.LBL_DESCRIPTION,
                    required: false
                },
            ],
            urls:'api/modules/taxtypes',
            
            routePath:{
                path:'taxtypes',
                detail:false
            }
            
        }
    },
    mounted() {
        this.childMethod()
    },
    methods:{
        childMethod(){
            if(this.generic == true){
                this.$refs.loadGeneric.loadGenericView(this.metaList,this.routePath);
            }
        }
    },
}
</script>