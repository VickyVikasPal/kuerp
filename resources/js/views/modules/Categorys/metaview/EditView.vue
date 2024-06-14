<template>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
                <breadcrumbs></breadcrumbs>
            </div>
            
        </div>
    </div>
    <GenericEdit v-if="generic" ref="loadGeneric"  :urls="urls"></GenericEdit>
    <CustomEdit v-else></CustomEdit>
</main>
</template>
<script>
import {ref} from 'vue'
import GenericEdit from '@/components/layout/shared/EditView.vue';
import CustomEdit from "@/views/modules/Categorys/EditView.vue";
import breadcrumbs from "@/views/modules/Categorys/MenuList.vue";
import lang from "@/views/modules/Categorys/language/en.js";

export default {
    name:'category-edit',
    components:{
        GenericEdit,
        CustomEdit,
        breadcrumbs,
    },
    data() {
        return {
            generic:true,
            metaList:[
                {
                    type:'text',
                    name:'name',
                    label:lang.LBL_CATEGORY_NAME,
                    required:true,
                },
                {
                    type:'selectbox',
                    name:'status',
                    label:lang.LBL_STATUS,
                    selected:'Active',
                    items:[
                        {value:'Active'},
                        {value:'Deactive'},
                    ]
                    
                },
            ],
            urls:'/modules/categorys',
            
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
                this.$refs.loadGeneric.loadGenericView(this.metaList,this.routePath);
            }
            
        }
    },
}
</script>