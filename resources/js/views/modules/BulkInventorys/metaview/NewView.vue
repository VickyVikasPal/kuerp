<template>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
                    <breadcrumbs></breadcrumbs>
                </div>

            </div>
        </div>
        <GenericNew v-if="generic" ref="loadGeneric"></GenericNew>
        <CustomNew v-else></CustomNew>

    </main>
</template>
<script>
    import { ref } from 'vue'
    import GenericNew from '@/components/layout/shared/NewView.vue';
    import CustomNew from "@/views/modules/BulkInventorys/NewView.vue";
    import breadcrumbs from "@/views/modules/BulkInventorys/MenuList.vue";
    import lang from "@/views/modules/BulkInventorys/language/en.js";
    export default {
        name: 'category-edit',
        components: {
            GenericNew,
            CustomNew,
            breadcrumbs,
        },
        data() {
            return {
                generic: false,
                metaList: [
                    {
                        type: 'text',
                        name: 'name',
                        label: lang.LBL_CATEGORY_NAME,
                        required: true,
                    },
                    {
                        type: 'selectbox',
                        name: 'status',
                        label: lang.LBL_STATUS,
                        selected: 'Active',
                        items: [
                            { value: 'Active' },
                            { value: 'Deactive' },
                        ]

                    },
                ],
                urls:'api/modules/categorys',
            
                routePath:{
                    path:'categorys',
                    detail:false
                },
            }
        },
        mounted() {
            this.childMethod();
            this.lang = lang;
        },
        methods: {
            childMethod(){
                if(this.generic == true){
                    this.$refs.loadGeneric.loadGenericView(this.metaList,this.routePath);
                }
            }
        },
    }
</script>