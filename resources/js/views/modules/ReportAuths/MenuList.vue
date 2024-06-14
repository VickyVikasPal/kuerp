<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <ul class="nav_breadcrumbs">
                    <li><router-link to="/modules/administration">{{lang.LBL_DEFAULT_ADMIN}}</router-link></li>
                    <li><router-link to="/modules/reportauths/edit">{{lang.LBL_NEW_REPORT_AUTHS}}</router-link></li>
                    <li><router-link to="/modules/reportauths">{{lang.LBL_VIEW_REPORT_AUTHS}}</router-link></li>
                </ul>
            </div>
        </div>
    </div>
    

</template>
<script>
import lang from "@/views/modules/ReportAuths/language/en";
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
