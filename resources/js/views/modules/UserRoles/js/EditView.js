import breadcrumbs from "@/views/modules/UserRoles/MenuList.vue";
import lang from "@/views/modules/UserRoles/language/en";
import dom_array from "@/components/layout/shared/common/Custom_dom.js";
import loader from "@/views/shared/loading/Loading.vue";

export default {
    name: "new-user-role",
    components: {
        breadcrumbs,
        loader,
    },
    data() {
        return {
            showDropdown: null,
            field_id: null,
            loading: false,
            modules: [],
            moduleOptions: [],
            action_data: [{
                'access': {},
                'delete': {},
                'export': {},
                'list': {},
                'edit': {},
                'view': {},
            }],
            availableOptions: [{
                'access': { 'Owner': 'Owner', 'Enabled': 'Enabled', 'Not Set': 'Not Set', 'Disabled': 'Disabled' },
                'delete': { 'Owner': 'Owner', 'Enabled': 'Enabled', 'Not Set': 'Not Set', 'Disabled': 'Disabled' },
                'export': { 'Owner': 'Owner', 'Enabled': 'Enabled', 'Not Set': 'Not Set', 'Disabled': 'Disabled' },
                'list': { 'Owner': 'Owner', 'Enabled': 'Enabled', 'Not Set': 'Not Set', 'Disabled': 'Disabled' },
                'edit': { 'Owner': 'Owner', 'Enabled': 'Enabled', 'Not Set': 'Not Set', 'Disabled': 'Disabled' },
                'view': { 'Owner': 'Owner', 'Enabled': 'Enabled', 'Not Set': 'Not Set', 'Disabled': 'Disabled' },
            }],
            userRole: {
            },
            lang: [],
            parentCompnent: null,
            record: null,
            showpassfiled: true,
            dom_array: [],
        }
    },
    watch: {
        modules: 'updateModuleOptions', // Watch for changes in modules
        availableOptions: 'updateModuleOptions', // Watch for changes in availableOptions
    },
    mounted() {
        this.getPermissions();
        this.updateModuleOptions();
        this.lang = lang;
        this.dom_array = dom_array;
        this.getUserRole();
    },
    methods: {
        updateModuleOptions() {
            // this.moduleOptions = this.modules.map(() => this.availableOptions.map(() => ''));
        },
        getUserRole() {
            const self = this;
            self.record = self.$route.params.id;
            if (typeof (self.record) != 'undefined') {
                self.showpassfiled = false;
                axios.get('/modules/userroles/' + self.$route.params.id).then(function (response) {
                    self.userRole = response.data;
                    self.userRole.status = self.userRole.status;
                    self.loading = false;
                }).catch(function () {
                    self.loading = false;
                });
            }
        },
        saveUserRole() {
            const errorMessages = document.getElementsByClassName('error-message');
            while (errorMessages.length > 0) {
                errorMessages[0].remove();
            }
            const self = this;

            self.loading = true;

            axios.put(`/modules/userroles/${self.$route.params.id}`, { module_data: self.action_data, name: self.userRole.name, status: self.userRole.status, id: self.userRole.id }).then(function (response) {
                self.loading = false;
                self.$router.push('/modules/userroles');
            }).catch(function () {
                self.loading = false;
                let err = localStorage.getItem('Errors');
                localStorage.removeItem('Errors');
            });
        },
        getPermissions() {
            const self = this;
            self.loading = true;
            axios.get('/modules/userroles/permissions', { params: { 'parent_id': self.$route.params.id } }).then(function (response) {

                self.modules = response.data.modules;
                self.action_data = response.data.permission;
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
    }

}