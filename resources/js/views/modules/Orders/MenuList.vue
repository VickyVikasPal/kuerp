<template>
     <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
        <li><router-link to="/modules/orders/edit">{{lang.LBL_ORDER_ADD}}</router-link></li>
        <li><router-link to="/modules/orders">{{lang.LBL_ORDER_VIEW}}</router-link></li>
    </ul>

</template>
<script>
import lang from "@/views/modules/Orders/language/en";
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
