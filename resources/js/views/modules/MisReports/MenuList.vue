<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <ul class="nav_breadcrumbs">
                    <li><router-link to="/modules/home">{{lang.LBL_HOME}}</router-link></li>
                    <li><router-link to="/modules/misreports">{{lang.LBL_MIS_REPORTS}}</router-link></li>
                </ul>
            </div>
        </div>
    </div>
    

</template>
<script>
import lang from "@/views/modules/MisReports/language/en";
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
