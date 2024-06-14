<template>
  
        <ul class="nav_breadcrumbs">
            <li><router-link to="/modules/administration">{{lang.LBL_ADMIN}}</router-link></li>
            <li><router-link to="/modules/userdashlets/edit">{{lang.LBL_USER_ADD_DASHLET}}</router-link></li>
            <li><router-link to="/modules/userdashlets">{{lang.LBL_USER_VIEW_DASHLET}}</router-link></li>
        </ul>
            

</template>
<script>
import lang from "@/views/modules/UserDashlets/language/en";
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
