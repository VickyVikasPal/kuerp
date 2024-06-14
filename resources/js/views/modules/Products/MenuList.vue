<template>
     <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
        <li><router-link to="/modules/products/edit">{{lang.LBL_PRODUCT_ADD}}</router-link></li>
        <li><router-link to="/modules/products">{{lang.LBL_PRODUCT_LIST}}</router-link></li>
    </ul>

</template>
<script>
import lang from "@/views/modules/Products/language/en";
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
