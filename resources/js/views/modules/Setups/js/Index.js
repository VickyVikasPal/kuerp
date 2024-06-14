import lang from "@/views/modules/Setups/language/en";
import breadcrumbs from "@/views/modules/Setups/MenuList.vue";
import mis_array from "@/views/modules/Setups/js/MisArray.js";

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