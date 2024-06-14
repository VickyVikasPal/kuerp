<template>
    <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
        <li><router-link to="/modules/statelists/edit">{{lang.LBL_ADD_STATE}}</router-link></li>
        <li><router-link to="/modules/statelists">{{lang.LBL_VIEW_STATE}}</router-link></li>
    </ul>
</template>
<script>
import lang from "@/views/modules/StateLists/language/en";
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
