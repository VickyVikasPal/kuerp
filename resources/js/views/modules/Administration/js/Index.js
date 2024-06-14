import lang from "@/views/modules/Administration/language/en";
import breadcrumbs from "@/views/modules/Administration/MenuList.vue";

export default {
    name: "administration",
    
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