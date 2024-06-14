import lang from "@/views/modules/Branchs/language/en";
import breadcrumbs from "@/views/modules/Branchs/MenuList.vue";

export default {
    name: "list-branchs",
   
    components: {
        breadcrumbs,
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
            branchList: [],
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
        this.getBranchs();
        this.lang = lang;
    },
    methods: {
        changePage(page) {
            const self = this;
            if ((page > 0) && (page <= self.pagination.totalPages) && (page !== self.page)) {
                self.page = page;
                self.getBranchs();
            }
        },
        changeSort() {
            const self = this;
            if (self.sort.order === 'asc') {
                self.sort.order = 'desc';
            } else if (self.sort.order === 'desc') {
                self.sort.order = 'asc';
            }
            self.getBranchs();
        },
        getBranchs() {
            const self = this;
            self.loading = true;
            axios.get('api/modules/branchs', {
                params: {
                    page: self.page,
                    sort: self.sort,
                    search: self.search,
                    perPage: self.perPage
                }
            }).then(function (response) {
                self.branchList = response.data.items;
               // console.log(self.branchList);
                self.pagination = response.data.pagination;
                if (self.pagination.totalPages < self.pagination.currentPage) {
                    self.page = self.pagination.totalPages;
                    self.getBranchs();
                } else {
                    self.loading = false;
                }
            }).catch(function () {
                self.loading = false;
            });
        },
    }
}