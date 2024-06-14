<template>
     <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
        <li><router-link to="/modules/invoices/edit">{{lang.LBL_INVOICE_ADD}}</router-link></li>
        <li><router-link to="/modules/invoices">{{lang.LBL_INVOICE_VIEW}}</router-link></li>
    </ul>

</template>
<script>
import lang from "@/views/modules/Invoices/language/en";
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
