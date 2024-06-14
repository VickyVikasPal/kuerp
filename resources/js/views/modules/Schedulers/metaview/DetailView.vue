<template>
    <main>
        <breadcrumbs></breadcrumbs>
        <GenericDetail v-if="generic" ref="loadGeneric"></GenericDetail>
        <CustomDetail v-else></CustomDetail>
    </main>
       

</template>

<script>
import { ref } from "vue";
import breadcrumbs from "@/views/modules/Schedulers/MenuList.vue";
import lang from "@/views/modules/Schedulers/language/en";
import GenericDetail from "@/components/layout/shared/DetailView.vue";
import CustomDetail from "@/views/modules/Schedulers/DetailView.vue";

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
                            name:'category_image',
                            label:'Category Image',
                            link:false,
                            routePath:'',
                            is_image:true,
                        },
                        {
                            name:'id',
                            label:'Id',
                            link:false,
                            routePath:'categorys'
                        },
                        {
                            name:'name',
                            label:'Name',
                            link:true,
                            routePath:'categorys'
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
                path:'categorys',
                label:'Edit',
                },
                {
                id:'delete',
                path:'categorys',
                label:'Delete',
                },
            ],
            routePath:{
                path:'categorys',
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
                this.$refs.loadGeneric.loadGenericView(this.metaList,this.moreBtn,this.routePath);
            }
        }
    }
}

</script>



