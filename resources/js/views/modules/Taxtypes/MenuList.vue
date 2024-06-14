<template>
   
        <ul class="nav_breadcrumbs">
            <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
            <li><router-link to="/modules/taxtypes/edit">{{lang.LBL_ADD_TAX}}</router-link></li>
            <li><router-link to="/modules/taxtypes">{{lang.LBL_VIEW_TAX}}</router-link></li>
        </ul>
           

</template>
<script>
import lang from "@/views/modules/Taxtypes/language/en";
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
     
}
</script>
