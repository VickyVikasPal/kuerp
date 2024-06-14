import lang from "@/views/modules/MisReports/language/en";
import breadcrumbs from "@/views/modules/MisReports/MenuList.vue";
import mis_array from "@/views/modules/MisReports/js/MisArray.js";

export default {
    name: "mis-reports",
    
    components: {
        breadcrumbs,
    },
   data(){
       return {
        lang:[],
        misarray:[],
       }
   },
    mounted() {
        this.lang = lang;
        this.misarray = mis_array;
    },
    
}