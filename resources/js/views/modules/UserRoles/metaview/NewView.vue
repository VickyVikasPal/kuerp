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
    import breadcrumbs from "@/views/modules/UserRoles/MenuList.vue";
    import lang from "@/views/modules/UserRoles/language/en";
    import GenericNew from "@/components/layout/shared/NewView.vue";
    import CustomNew from "@/views/modules/UserRoles/NewView.vue";

    export default {
        name: "edit-User-Role",
       
        components: {
            breadcrumbs,
            GenericNew,
            CustomNew,
        },
        data() {
            return {
                generic: false,
                metaList: [
                    {
                        type: 'text',
                        name: 'first_name',
                        label: lang.LBL_FIRST_NAME,
                        required: true
                    },

                ],
                urls: 'api/modules/user-roles',
                routePath: {
                    path: 'user-roles',
                    detail: false
                }

            }
        },
        mounted() {
            this.childMethod()
        },
        methods: {
            childMethod() {
                if (this.generic == true) {
                    this.$refs.loadGeneric.loadGenericView(this.metaList, this.routePath);
                }
            }
        },
    }
</script>