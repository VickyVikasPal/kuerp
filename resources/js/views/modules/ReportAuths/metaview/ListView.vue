<template>
    <main>
        <breadcrumbs></breadcrumbs>
        <GenericList v-if="generic" ref="loadGeneric"></GenericList>
        <CustomList v-else></CustomList>
    </main>
</template>



<script>
import { ref } from "vue";
import breadcrumbs from "@/views/modules/ReportAuths/MenuList.vue";
import lang from "@/views/modules/ReportAuths/language/en";
import GenericList from "@/components/layout/shared/ListView.vue";
import CustomList from "@/views/modules/ReportAuths/ListView.vue";

export default {
name: "new-users",
components: {
    breadcrumbs,
    GenericList,
    CustomList,
    },
    data(){
        return{
            generic:false,
            metaList:[
                {
                    label:'User Name',
                    link:false,
                    linkOtherModule:false,
                    moduleName:'UserRole',/// moduleName is required
                    routePath:'users'/// routePath is required at start of object
                },
                {
                    label:'User Email',
                    link:true,
                    linkOtherModule:false,
                    routePath:'users'/// routePath is required at start of object
                },
                {
                    label:'User Status',
                    link:false,
                    linkOtherModule:false,
                    routePath:''
                },
                {
                    label:'User Role',
                    link:false,
                    linkOtherModule:false,
                    routePath:''
                },
            ],
            columns: ['username', 'email', 'status', 'user_role'],

        }
    },
    mounted() {
        this.childMethod();
        this.$emit('MetaView','Awesome')
    },
    methods:{

        childMethod(){
            if(this.generic == true){
                 this.$refs.loadGeneric.loadGenericView(this.metaList,this.columns);
            }
        }
    }
}

</script>



