import breadcrumbs from "@/views/modules/UserDashlets/MenuList.vue";
import lang from "@/views/modules/UserDashlets/language/en";

export default {
    name: "detail-userdashlet",
   
    components: {
        breadcrumbs,
       
    },
    data() {
        return {
            loading: true,
            deleteProductModal: false,
            product: {
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
        this.getProduct();
        this.lang = lang;
    },
    methods: {
        saveProduct() {
            const self = this;
            self.loading = true;
            axios.put('api/dashboard/modules/products/' + self.$route.params.id, self.product).then(function () {
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
        getProduct() {
            const self = this;
            self.loading = true;
            axios.get('api/dashboard/modules/products/' + self.$route.params.id).then(function (response) {
                self.product = response.data;
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        deleteProduct() {
            const self = this;
            axios.delete('api/dashboard/modules/products/' + self.$route.params.id).then(function () {
                self.$notify({
                    title: self.$i18n.t('Success').toString(),
                    text: self.$i18n.t('Data deleted successfully').toString(),
                    type: 'success'
                });
                self.$router.push('/modules/products');
            }).catch(function () {
                self.loading = false;
                self.deleteProductModal = false;
            });
        },
        
    }
}