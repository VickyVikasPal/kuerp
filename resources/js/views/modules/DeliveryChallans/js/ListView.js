import lang from "@/views/modules/DeliveryChallans/language/en";
import breadcrumbs from "@/views/modules/DeliveryChallans/MenuList.vue";
import Datepicker from 'vuejs3-datepicker';
export default {
    name: "list-deliveryChallans",
    components: {
        breadcrumbs,
        Datepicker,
    },
    data() {
        return {
            page: 1,
            search: '',
            sort: {
                order: 'asc',
                column: 'created_at',
            },
            perPage: 10,
            loading: true,
            productList: [],
            pagination: {
                currentPage: 0,
                perPage: 0,
                total: 0,
                totalPages: 0
            },
            lang:[],
           
        }
    },
    mounted() {
        this.getDeliverys();
        this.lang = lang;
    },
    methods: {
        changePage(page) {
            const self = this;
            if ((page > 0) && (page <= self.pagination.totalPages) && (page !== self.page)) {
                self.page = page;
                self.getDeliverys();
            }
        },
        changeSort() {
            const self = this;
            if (self.sort.order === 'asc') {
                self.sort.order = 'desc';
            } else if (self.sort.order === 'desc') {
                self.sort.order = 'asc';
            }
            self.getDeliverys();
        },
        getDeliverys() {
            const self = this;
            self.loading = true;
            axios.get('api/modules/deliverychallans', {
                params: {
                    page: self.page,
                    sort: self.sort,
                    search: self.search,
                    perPage: self.perPage
                }
            }).then(function (response) {
                self.productList = response.data.items;
               // console.log(self.productList);
                self.pagination = response.data.pagination;
                if (self.pagination.totalPages < self.pagination.currentPage) {
                    self.page = self.pagination.totalPages;
                    self.getProducts();
                } else {
                    self.loading = false;
                }
            }).catch(function () {
                self.loading = false;
            });
        },
    }
}