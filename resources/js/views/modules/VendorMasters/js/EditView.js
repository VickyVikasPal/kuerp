import breadcrumbs from "@/views/modules/VendorMasters/MenuList.vue";
import lang from "@/views/modules/VendorMasters/language/en";

export default {
    name: "edit-vendorMasters",
    components: {
        breadcrumbs,
    },
    data() {
        return {
            loading: true,
            products: [],
            product: {
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
        this.getProducts();
        this.checkPermisson();
        this.lang = lang;
    },
    methods: {
        saveProduct() {
            const self = this;
            self.loading = true;
            axios.post('api/modules/products', self.product).then(function (response) {
                self.loading = false;
                self.$notify({
                    title: self.$i18n.t('Success').toString(),
                    text: self.$i18n.t('Data saved correctly').toString(),
                    type: 'success'
                });
                self.$router.push('/modules/products/' + response.data.product.id + '/edit');
            }).catch(function () {
                self.loading = false;
            });
        },
        getProducts() {
            const self = this;
            self.loading = false;
           
            /* axios.get('api/dashboard/modules/products').then(function (response) {
                //self.products = response.data;
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