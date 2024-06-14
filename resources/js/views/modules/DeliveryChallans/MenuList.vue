<template>
     <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
        <li><router-link to="/modules/deliverychallans/edit">{{lang.LBL_DELIVERY_CHALLAN_ADD}}</router-link></li>
        <li><router-link to="/modules/deliverychallans">{{lang.LBL_DELIVERY_CHALLAN_VIEW}}</router-link></li>
    </ul>

</template>
<script>
import lang from "@/views/modules/DeliveryChallans/language/en";
export default {
    name: "breadcrumbs",
    data() {
        return {
            lang:[],
            defaultpath:null,
        }
     },
     mounted() {
        this.lang = lang;
    },
     
}
</script>
