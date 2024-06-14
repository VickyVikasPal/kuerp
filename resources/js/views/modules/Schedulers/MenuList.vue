<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <ul class="nav_breadcrumbs">
                    <li><router-link to="/modules/administration">{{lang.LBL_ADMIN}}</router-link></li>
                    <li><router-link to="/modules/schedulers/edit">{{lang.LBL_ADD_SCHEDULERS}}</router-link></li>
                    <li><router-link to="/modules/schedulers">{{lang.LBL_VIEW_SCHEDULERS}}</router-link></li>
                </ul>
            </div>
        </div>
    </div>

</template>
<script>
import lang from "@/views/modules/Schedulers/language/en";
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
