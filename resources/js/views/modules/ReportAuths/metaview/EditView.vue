<template>
    <main>
        <breadcrumbs></breadcrumbs>
        <GenericEdit v-if="generic" ref="loadGeneric" :urls="urls"></GenericEdit>
        <CustomEdit v-else></CustomEdit>   
    </main> 
</template>

<script>
import { ref } from "vue";
import breadcrumbs from "@/views/modules/ReportAuths/MenuList.vue";
import lang from "@/views/modules/ReportAuths/language/en";
import GenericEdit from "@/components/layout/shared/EditView.vue";
import CustomEdit from "@/views/modules/ReportAuths/EditView.vue";

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
                    name:'first_name',
                    label:'First Name',
                    required: true
                },
                {
                    type:'text',
                    name:'last_name',
                    label:'Last Name',
                    required: false
                },
                {
                    type:'text',
                    name:'username',
                    label:'User Name',
                    required: true
                }, 
                {
                    type:'text',
                    name:'email',
                    label:'User Email',
                    required: true
                }, 
                {
                    type:'text',
                    name:'phone',
                    label:'Phone',
                    required: true
                },
                {
                    type:'password',
                    name:'password',
                    label:'User Password',
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
                },
                {
                    type:'selectcomponent',
                    name:'name',
                    label:'User Role',
                    required: true,
                    linkComponent:'user-role',
                    parent_id:'parent_id',
                    parent_type:'parent_type',
                },
                {
                    type:'uploadfile',
                    name:'user_image',
                    label:'User Image',
                    required: false
                }             
               
            ],
            urls:'api/modules/users',
            
            routePath:{
                path:'users',
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