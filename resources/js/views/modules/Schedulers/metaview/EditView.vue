<template>
    <main>
        <breadcrumbs></breadcrumbs>
        <GenericEdit v-if="generic" ref="loadGeneric" :urls="urls"></GenericEdit>
        <CustomEdit v-else></CustomEdit>   
    </main> 
</template>

<script>
import { ref } from "vue";
import breadcrumbs from "@/views/modules/Schedulers/MenuList.vue";
import lang from "@/views/modules/Schedulers/language/en";
import GenericEdit from "@/components/layout/shared/EditView.vue";
import CustomEdit from "@/views/modules/Schedulers/EditView.vue";

export default {
name: "new-product",
components: {
        breadcrumbs, 
        GenericEdit,
        CustomEdit,
    },
    data(){
        return {
            generic:false,
            metaList:[
                
                {
                    type:'text',
                    name:'name',
                    label:'Category Name',
                    required: false
                },
                {
                    type:'uploadfile',
                    name:'category_image',
                    label:'Category Image',
                    required: false
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
                }
                
               
            ],
            urls:'api/modules/categorys',
            
            routePath:{
                path:'categorys',
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