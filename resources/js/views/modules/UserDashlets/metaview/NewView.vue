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
import breadcrumbs from "@/views/modules/UserDashlets/MenuList.vue";
import lang from "@/views/modules/UserDashlets/language/en";
import GenericNew from "@/components/layout/shared/NewView.vue";
import CustomNew from "@/views/modules/UserDashlets/NewView.vue";

export default {
name: "create-userDashlet",
components: {
        breadcrumbs, 
        GenericNew,
        CustomNew,
    },
    data(){
        return {
            generic:false,
            metaList:[
                
                {
                    type:'text',
                    name:'name',
                    label:'Taxtype Name',
                    required: true
                },
                {
                    type:'text',
                    name:'tax',
                    label:'Tax Rate',
                    required: true
                },
                {
                    type:'selectbox',
                    name:'status',
                    label: 'Status',
                    items:[
                        {value: 'Active'},
                        {value: 'Inactive'},
                    ],
                    required: true
                },                
               {
                    type:'textarea',
                    name:'description',
                    label:'Description',
                    required: false
                },
            ],
            urls:'api/modules/userdashlets',
            
            routePath:{
                path:'userdashlets',
                detail:false
            }
            
        }
    },
    mounted() {
        this.childMethod();
        this.lang = lang;
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