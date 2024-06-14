import lang from "@/views/modules/ReportAuths/language/en";
import breadcrumbs from "@/views/modules/ReportAuths/MenuList.vue";

export default {
    name: "list-report-auths",
  
    components: {
        breadcrumbs,
    },
    data() {
        return {
            lang: [],
        }
    },
    mounted() {
        this.lang = lang;
    },
    methods: {
        
    
        
    }
}