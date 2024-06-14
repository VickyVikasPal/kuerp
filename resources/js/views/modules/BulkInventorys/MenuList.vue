<template>
     <ul class="nav_breadcrumbs">
        <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
        <li><router-link to="/modules/bulkinventorys/edit">{{lang.LBL_INVENTORY_ADD}}</router-link></li>
        <li><router-link to="/modules/bulkinventorys">{{lang.LBL_INVENTORY_LIST}}</router-link></li>
    </ul>

</template>
<script>
import lang from "@/views/modules/BulkInventorys/language/en";
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
