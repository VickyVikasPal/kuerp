<template>
    
    <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/administration">{{lang.LBL_DEFAULT_ADMIN}}</router-link></li>
        <li><router-link to="/modules/userreports/edit">{{lang.LBL_ADD_USER_REPORTS}}</router-link></li>
        <li><router-link to="/modules/userreports">{{lang.LBL_VIEW_USER_REPORTS}}</router-link></li>
        <li><router-link to="/modules/userreports/pdfrequest">{{lang.LBL_PDF_REQUESTS}}</router-link></li>
    </ul>
        
    

</template>
<script>
import lang from "@/views/modules/UserReports/language/en";
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
