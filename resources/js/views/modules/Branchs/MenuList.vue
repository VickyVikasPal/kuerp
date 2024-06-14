<template>
    <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
        <li><router-link to="/modules/branchs/edit">{{lang.LBL_ADD_BRANCH}}</router-link></li>
        <li><router-link to="/modules/branchs">{{lang.LBL_VIEW_BRANCH}}</router-link></li>
    </ul>
</template>
<script>
import lang from "@/views/modules/Branchs/language/en";

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
