import lang from "@/views/modules/FormatSettings/language/en";
import breadcrumbs from "@/views/modules/FormatSettings/MenuList.vue";

export default {
    name: "edit-current",
    
    components: {
        breadcrumbs,
    },
   data(){
       return {
        lang:[],
       }
   },
    mounted() {
        this.lang = lang;
    },
    
}