<template>
     <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
        <li><router-link to="/modules/categorys/edit">{{lang.LBL_CATEGORY_ADD}}</router-link></li>
        <li><router-link to="/modules/categorys">{{lang.LBL_CATEGORY_LIST}}</router-link></li>
    </ul>

</template>
<script>
import lang from "@/views/modules/Categorys/language/en";
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
