import lang from "@/views/modules/Categorys/language/en";
import breadcrumbs from "@/views/modules/Categorys/MenuList.vue";

export default {
    name: "list-categorys",
    components: {
        breadcrumbs,
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
        this.getProducts();
        this.lang = lang;
    },
    methods: {
        changePage(page) {
            const self = this;
            if ((page > 0) && (page <= self.pagination.totalPages) && (page !== self.page)) {
                self.page = page;
                self.getProducts();
            }
        },
        changeSort() {
            const self = this;
            if (self.sort.order === 'asc') {
                self.sort.order = 'desc';
            } else if (self.sort.order === 'desc') {
                self.sort.order = 'asc';
            }
            self.getProducts();
        },
        getProducts() {
            const self = this;
            self.loading = true;
            axios.get('api/modules/products', {
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