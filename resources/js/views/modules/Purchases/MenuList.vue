<template>
     <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
        <li><router-link to="/modules/purchases/edit">{{lang.LBL_PURCHASE_ADD}}</router-link></li>
        <li><router-link to="/modules/purchases">{{lang.LBL_PURCHASE_VIEW}}</router-link></li>
    </ul>

</template>
<script>
import lang from "@/views/modules/Purchases/language/en";
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
        this.remove();
    },
    methods: {
        remove(){
            localStorage.removeItem('purchase_status');
        }
    }
     
}
</script>
