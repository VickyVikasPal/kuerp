import breadcrumbs from "@/views/modules/Branchs/MenuList.vue";
import lang from "@/views/modules/Branchs/language/en";

export default {
    name: "new-branch",
   
    components: {
        breadcrumbs,
    },
    data() {
        return {
            loading: true,
            branchs: [],
            branch: {
                category: null,
                name: null,
                price: null,
                status: true,
                description: null,
            },
            lang:[],
        }
    },
    mounted() {
        this.getBranchs();
        this.checkPermisson();
        this.lang = lang;
    },
    methods: {
        saveBranch() {
            const self = this;
            self.loading = true;
            axios.post('/modules/branchs', self.branch).then(function (response) {
                self.loading = false;
                self.$notify({
                    title: self.$i18n.t('Success').toString(),
                    text: self.$i18n.t('Data saved correctly').toString(),
                    type: 'success'
                });
                self.$router.push('/modules/branchs/' + response.data.branch.id + '/edit');
            }).catch(function () {
                self.loading = false;
            });
        },
        getBranchs() {
            const self = this;
            self.loading = false;
           
            /* axios.get('/dashboard/modules/branchs').then(function (response) {
                //self.branchs = response.data;
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            }); */
        },
        checkPermisson() {
            const self = this;
            self.loading = false;
        },
    }
}