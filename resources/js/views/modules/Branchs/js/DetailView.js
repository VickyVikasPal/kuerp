import breadcrumbs from "@/views/modules/Branchs/MenuList.vue";
import lang from "@/views/modules/Branchs/language/en";

export default {
    name: "edit-branch",
    
    components: {
        breadcrumbs,
      
    },
    data() {
        return {
            loading: true,
            deleteBranchModal: false,
            branch: {
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
        this.getBranch();
        this.lang = lang;
    },
    methods: {
        saveBranch() {
            const self = this;
            self.loading = true;
            axios.put('api/modules/branchs/' + self.$route.params.id, self.branch).then(function () {
                self.loading = false;
                self.$notify({
                    title: self.$i18n.t('Success').toString(),
                    text: self.$i18n.t('Data updated correctly').toString(),
                    type: 'success'
                });
            }).catch(function () {
                self.loading = false;
            });
        },
        getBranch() {
            const self = this;
            self.loading = true;
            axios.get('api/modules/branchs/' + self.$route.params.id).then(function (response) {
                self.branch = response.data;
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        deleteBranch() {
            const self = this;
            axios.delete('api/modules/branchs/' + self.$route.params.id).then(function () {
                self.$notify({
                    title: self.$i18n.t('Success').toString(),
                    text: self.$i18n.t('Data deleted successfully').toString(),
                    type: 'success'
                });
                self.$router.push('/modules/branchs');
            }).catch(function () {
                self.loading = false;
                self.deleteBranchModal = false;
            });
        },
        
    }
}