import lang from "@/views/modules/UserRoles/language/en";
export default {
    name: "edit-user-role",
    data() {
        return {
            loading: true,
            deleteUserRoleModal: false,
            userRole: {},
            lang:[],
        }
    },
    mounted() {
        this.getUserRole();
        this.lang = lang;
    },
    methods: {
        getUserRole() {
            const self = this;
            self.loading = true;
            
            axios.get('api/modules/user-roles/' + self.$route.params.id).then(function (response) {
                self.userRole = response.data;
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        
    }
}