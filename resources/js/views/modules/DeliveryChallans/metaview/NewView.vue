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
    import CustomNew from "@/views/modules/DeliveryChallans/NewView.vue";
    import breadcrumbs from "@/views/modules/DeliveryChallans/MenuList.vue";
    import lang from "@/views/modules/DeliveryChallans/language/en.js";
    export default {
        name: 'new-deliveryChallans',
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
                        name: 'customer_name',
                        label: lang.LBL_CUSTOMER_NAME,
                        required: true,
                    },
                    {
                        type: 'text',
                        name: 'firm_name',
                        label: lang.LBL_FIRM_NAME,
                        required: false,
                    },
                    {
                        type: 'text',
                        name: 'contact_number',
                        label: lang.LBL_CONTACT_NO,
                        required: false,
                    },
                    {
                        type: 'text',
                        name: 'email_id',
                        label: lang.LBL_EMAIL_ID,
                        required: false,
                    },
                    {
                        type: 'selectbox',
                        name: 'gst_status',
                        label: lang.LBL_GST_STATUS,
                        selected: 'Yes',
                        items: [
                            { value: 'Yes' },
                            { value: 'No' },
                        ],
                        required: false,

                    },
                    {
                        type: 'text',
                        name: 'gst_number',
                        label: lang.LBL_GST_NUMBER,
                        required: false,
                    },
                    {
                        type: 'textarea',
                        name: 'description',
                        label: lang.LBL_ADDRESS,
                        required: false,
                    },
                   
                    {
                        type: 'text',
                        name: 'area',
                        label: lang.LBL_AREA,
                        required: false,
                    },
                    {
                        type: 'text',
                        name: 'state',
                        label: lang.LBL_STATE,
                        required: false,
                    },
                    {
                        type: 'text',
                        name: 'pin_number',
                        label: lang.LBL_PIN,
                        required: false,
                    },
                ],
                urls:'api/modules/deliverychallans',
            
                routePath:{
                    path:'deliverychallans',
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