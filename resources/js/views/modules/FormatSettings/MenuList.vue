<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <ul class="nav_breadcrumbs">
                    <li><router-link to="/modules/administration">{{lang.LBL_ADMIN}}</router-link></li>
                    <li><router-link to="/modules/formatsetting/addprint">{{lang.LBL_ADD_PRINT}}</router-link></li>
                    <li><router-link to="/modules/formatsetting/viewprint">{{lang.LBL_VIEW_PRINT}}</router-link></li>
                    <li><router-link to="/modules/formatsetting/addcurrentsetting">{{lang.LBL_CURRENT_SETTINGS}}</router-link></li>
                    <li><router-link to="/modules/formatsetting/viewcurrentsetting">{{lang.LBL_VIEW_CURRENT_SETTINGS}}</router-link></li>
                </ul>
            </div>
        </div>
    </div>

</template>
<script>
import lang from "@/views/modules/FormatSettings/language/en";
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
