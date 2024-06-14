import breadcrumbs from "@/views/modules/UserReports/MenuList.vue";
import lang from "@/views/modules/UserReports/language/en";

export default {
    name: "pdf-request",
   
    components: {
        breadcrumbs,
    },
    data() {
        return {
            lang:[],
        }
    },
    mounted() {
        this.lang = lang;
    },
    methods: {
       
    }
}