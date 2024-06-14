<template>
   
    <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
        <li><router-link to="/modules/userroles/edit">{{lang.LBL_ADD_USER_ROLE}}</router-link></li>
        <li><router-link to="/modules/userroles">{{lang.LBL_VIEW_USER_ROLE}}</router-link></li>
    </ul>

</template>
<script>
import lang from "@/views/modules/UserRoles/language/en";
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
