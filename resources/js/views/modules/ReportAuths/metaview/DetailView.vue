<template>
    <main>
        <breadcrumbs></breadcrumbs>
        <GenericDetail v-if="generic" ref="loadGeneric"></GenericDetail>
        <CustomDetail v-else></CustomDetail>
    </main>
       

</template>

<script>
import { ref } from "vue";
import breadcrumbs from "@/views/modules/ReportAuths/MenuList.vue";
import lang from "@/views/modules/ReportAuths/language/en";
import GenericDetail from "@/components/layout/shared/DetailView.vue";
import CustomDetail from "@/views/modules/ReportAuths/DetailView.vue";

export default {
name: "new-product",
components: {
        breadcrumbs,
        GenericDetail,
        CustomDetail,
    },
    data(){
        return{
            generic:false,
            metaList:[
                {
                    name:'col1',
                    items:[
                        {
                            name:'id',
                            label:'Id',
                            link:false,
                            routePath:'users'
                        },
                        {
                            name:'username',
                            label:'User Name',
                            link:false,
                            routePath:'',
                            is_image:false,
                        },
                        {
                            name:'email',
                            label:'Email',
                            link:false,
                            routePath:'users'
                        },
                    ]   
                },
                       
               
              
                {
                    name:'col2',
                    items:[
                        {
                            name:'status',
                            label:'Status',
                            link:false,
                            routePath:''
                        },
                        {
                            name:'created_at',
                            label:'Date Created',
                            link:false,
                            routePath:''
                        },
                        {
                            name:'updated_at',
                            label:'Date Modified',
                            link:false,
                            routePath:''
                        },
                    ]
                }
                        
               
                 
                               
            ],
            moreBtn:[
                {
                id:'edit',
                path:'users',
                label:'Edit',
                },
                {
                id:'delete',
                path:'users',
                label:'Delete',
                },
            ],
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
                this.$refs.loadGeneric.loadGenericView(this.metaList,this.moreBtn,this.routePath);
            }
        }
    }
}

</script>



