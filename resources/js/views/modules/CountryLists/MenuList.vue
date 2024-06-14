<template>
    <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
        <li><router-link to="/modules/countrylists/edit">{{lang.LBL_ADD_COUNTRY}}</router-link></li>
        <li><router-link to="/modules/countrylists">{{lang.LBL_VIEW_COUNTRY}}</router-link></li>
    </ul>
</template>
<script>
import lang from "@/views/modules/CountryLists/language/en";
export default {
    name: "breadcrumbs",
    data() {
        return {
            lang:[],
           
        }
     },
     mounted() {
        this.lang = lang;
       
    },
    methods:{
       
    }
}
</script>
