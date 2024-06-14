import breadcrumbs from "@/views/modules/UserReports/MenuList.vue";
import lang from "@/views/modules/UserReports/language/en";

export default {
    name: "create-userReport",
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