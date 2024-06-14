<template>
    <main>
       <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
                     <breadcrumbs></breadcrumbs>
                </div>
              
            </div>
        </div>
        <GenericEdit v-if="generic" ref="loadGeneric" :urls="urls"></GenericEdit>
        <CustomEdit v-else></CustomEdit>   
    </main> 
</template>

<script>
import { ref } from "vue";
import breadcrumbs from "@/views/modules/Branchs/MenuList.vue";
import lang from "@/views/modules/Branchs/language/en";
import GenericEdit from "@/components/layout/shared/EditView.vue";
import CustomEdit from "@/views/modules/Branchs/EditView.vue";

export default {
name: "edit-branch",
components: {
        breadcrumbs, 
        GenericEdit,
        CustomEdit,
    },
    data(){
        return {
            generic:true,
            metaList:[
                {
                    type:'text',
                    name:'name',
                    label:lang.LBL_BRANCH_NAME,
                    required: true
                },
                {
                    type:'text',
                    name:'branch_code',
                    label:lang.LBL_BRANCH_CODE,
                    required: true
                },
                {
                    type:'text',
                    name:'upload_path',
                    label: lang.LBL_UPLOAD_DIR,
                    required: false
                },
                {
                    type:'textarea',
                    name:'description',
                    label: lang.LBL_DESCRIPTION,
                    required: false
                },
                {
                    type:'textarea',
                    name:'ip_address',
                    label: lang.LBL_IPADDRESS,
                    required: false
                },
                {
                    type:'selectbox',
                    name:'status',
                    label: lang.LBL_STATUS,
                    items:[
                        {value: 'Active'},
                        {value: 'InActive'},
                    ],
                    required: false
                },
                {
                    type:'checkbox',
                    name:'default_branch',
                    label: lang.LBL_DEFAULT_BRANCH,
                    value:'1',
                    required: false
                },
                {
                    type:'checkbox',
                    name:'for_mobileapp',
                    label: lang.LBL_SHOW_MOBILE_APP,
                    value:'1',
                    required: false
                },
            ],
            
            urls:'/modules/branchs',
            
            routePath:{
                path:'branchs',
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