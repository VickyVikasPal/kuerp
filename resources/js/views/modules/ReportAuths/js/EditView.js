import breadcrumbs from "@/views/modules/ReportAuths/MenuList.vue";
import lang from "@/views/modules/ReportAuths/language/en";

export default {
    name: "new-reports-auths",
    components: {
        breadcrumbs,
    },

    data() {
        return {
            dropdown:false,
            lang:[],
        }
    },
    mounted() {
        this.lang = lang;
    },
    methods: {
        
    }
}