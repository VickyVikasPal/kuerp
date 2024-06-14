<template>
     <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
        <li><router-link to="/modules/clientmasters/edit">{{lang.LBL_CLIENTMASTER_ADD}}</router-link></li>
        <li><router-link to="/modules/clientmasters">{{lang.LBL_CLIENTMASTER_VIEW}}</router-link></li>
    </ul>

</template>
<script>
import lang from "@/views/modules/ClientMasters/language/en";
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
