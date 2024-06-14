import breadcrumbs from "@/views/modules/Users/MenuList.vue";
import lang from "@/views/modules/Users/language/en";

export default {
    name: "edit-user",
    components: {
        breadcrumbs,
      
    },
    data() {
        return {
            loading: true,
            deleteUserModal: false,
            user: {
                name: null,
                email: null,
                role_id: null,
                status: true,
                password: null,
            },
            lang:[],
        }
    },
    mounted() {
        this.getUser();
        this.lang = lang;
    },
    methods: {
        getUser() {
            const self = this;
            self.loading = true;
            axios.get('api/modules/users/' + self.$route.params.id).then(function (response) {
                self.user = response.data;
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        
    }
}