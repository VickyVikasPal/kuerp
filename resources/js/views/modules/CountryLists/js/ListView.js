import lang from "@/views/modules/CountryLists/language/en";
export default {
    name: "list-countrylists",
    components: {
    },
    data() {
        return {
            page: 1,
            search: '',
            sort: {
                order: 'asc',
                column: 'date_entered',
            },
            perPage: 10,
            loading: true,
            exampleList: [],
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
        this.getExamples();
        this.lang = lang;
    },
    methods: {
        changePage(page) {
            const self = this;
            if ((page > 0) && (page <= self.pagination.totalPages) && (page !== self.page)) {
                self.page = page;
                self.getExamples();
            }
        },
        changeSort() {
            const self = this;
            if (self.sort.order === 'asc') {
                self.sort.order = 'desc';
            } else if (self.sort.order === 'desc') {
                self.sort.order = 'asc';
            }
            self.getExamples();
        },
        getExamples() {
            const self = this;
            self.loading = true;
            axios.get('api/modules/countrylists', {
                params: {
                    page: self.page,
                    sort: self.sort,
                    search: self.search,
                    perPage: self.perPage
                }
            }).then(function (response) {
                self.exampleList = response.data.items;
                self.pagination = response.data.pagination;
                if (self.pagination.totalPages < self.pagination.currentPage) {
                    self.page = self.pagination.totalPages;
                    self.getExamples();
                } else {
                    self.loading = false;
                }
            }).catch(function () {
                self.loading = false;
            });
        },
    }
}