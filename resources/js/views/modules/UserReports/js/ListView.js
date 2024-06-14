import lang from "@/views/modules/UserReports/language/en";
import breadcrumbs from "@/views/modules/UserReports/MenuList.vue";

export default {
    name: "list-userReport",
  
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