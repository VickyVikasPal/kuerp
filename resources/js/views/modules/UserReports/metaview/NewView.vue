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
import breadcrumbs from "@/views/modules/UserReports/MenuList.vue";
import lang from "@/views/modules/UserReports/language/en";
import GenericNew from "@/components/layout/shared/NewView.vue";
import CustomNew from "@/views/modules/UserReports/NewView.vue";

export default {
name: "create-userReport",
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
            urls:'api/modules/usersreports',
            
            routePath:{
                path:'usersreports',
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