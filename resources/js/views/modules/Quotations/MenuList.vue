<template>
     <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
        <li><router-link to="/modules/quotations/edit">{{lang.LBL_QUOTATION_ADD}}</router-link></li>
        <li><router-link to="/modules/quotations">{{lang.LBL_QUOTATION_VIEW}}</router-link></li>
    </ul>

</template>
<script>
import lang from "@/views/modules/Quotations/language/en";
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
