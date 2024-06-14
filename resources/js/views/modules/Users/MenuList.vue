<template>
     
        <ul class="nav_breadcrumbs">
            <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
            <li><router-link to="/modules/users/edit">{{lang.LBL_ADD_USER}}</router-link></li>
            <li><router-link to="/modules/users">{{lang.LBL_VIEW_USER}}</router-link></li>
        </ul>
          

</template>
<script>
import lang from "@/views/modules/Users/language/en";
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
