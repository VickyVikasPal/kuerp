<template>
     <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
        <li><router-link to="/modules/vendorMasters/edit">{{lang.LBL_VENDORMASTER_ADD}}</router-link></li>
        <li><router-link to="/modules/vendorMasters">{{lang.LBL_VENDORMASTER_VIEW}}</router-link></li>
    </ul>

</template>
<script>
import lang from "@/views/modules/VendorMasters/language/en";
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
