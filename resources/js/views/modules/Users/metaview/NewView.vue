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
import breadcrumbs from "@/views/modules/Users/MenuList.vue";
import lang from "@/views/modules/Users/language/en";
import GenericNew from "@/components/layout/shared/NewView.vue";
import CustomNew from "@/views/modules/Users/NewView.vue";

export default {
name: "create-users",
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
                    name:'first_name',
                    label: lang.LBL_FIRST_NAME,
                    required: true
                },
                {
                    type:'text',
                    name:'last_name',
                    label: lang.LBL_LAST_NAME,
                    required: false
                },
                {
                    type:'text',
                    name:'username',
                    label: lang.LBL_USER_NAME,
                    required: true
                }, 
                {
                    type:'text',
                    name:'email',
                    label: lang.LBL_USER_EMAIL,
                    required: true
                }, 
                {
                    type:'text',
                    name:'phone',
                    label: lang.LBL_PHONE,
                    required: true
                },
                {
                    type:'password',
                    name:'password',
                    label: lang.LBL_USER_PASSWORD,
                    required: false
                },
                {
                    type:'selectbox',
                    name:'status',
                    label: lang.LBL_USER_STATUS,
                    items:[
                        {value: 'Active'},
                        {value: 'Inactive'},
                    ],
                    required: true
                },
                {
                    type:'selectcomponent',
                    name:'user-role_name',
                    label: lang.LBL_ROLE,
                    required: false,
                    linkComponent:'user-role',
                    parent_id:'role_id',
                    parent_type:'parent_type',
                },
                {
                    type:'uploadfile',
                    name:'user_image',
                    label: lang.LBL_USER_IMAGE,
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
        this.childMethod();
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