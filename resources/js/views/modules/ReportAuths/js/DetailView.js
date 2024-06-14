import breadcrumbs from "@/views/modules/ReportAuths/MenuList.vue";
import lang from "@/views/modules/ReportAuths/language/en";

export default {
    name: "edit-reports-detail",
   
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