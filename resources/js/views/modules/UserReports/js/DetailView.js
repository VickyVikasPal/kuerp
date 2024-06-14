import breadcrumbs from "@/views/modules/UserReports/MenuList.vue";
import lang from "@/views/modules/UserReports/language/en";

export default {
    name: "detail-userReport",
   
    components: {
        breadcrumbs,
    },
    data() {
        return {
            isActive:false,
            lang:[],
        }
    },
    mounted() {
        this.lang = lang;
    },
    methods: {
        openAction() {
            this.isActive = !this.isActive;
        },
    }
}