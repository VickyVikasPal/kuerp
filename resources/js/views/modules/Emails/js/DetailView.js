import lang from "@/views/modules/Emails/language/en";
import breadcrumbs from "@/views/modules/Emails/MenuList.vue";

export default {
    name: "email-details",
    
    components: {
        breadcrumbs,
    },
   data(){
       return {
        lang:[],
        record_id:null,
        record:null,
        emailstatus: {

        },
       }
   },
    mounted() {
        this.lang = lang;
        this.getEmailStatus();
    },
    methods: {
        getEmailStatus() {
            const self = this;
            self.record = self.$route.params.id;
            if (typeof (self.record) != 'undefined') {
                axios.get('api/modules/emails/' + self.$route.params.id).then(function (response) {
                    self.emailstatus = response.data;
                    self.loading = false;
                }).catch(function () {
                    self.loading = false;
                });
            }
        },
    }
    
}