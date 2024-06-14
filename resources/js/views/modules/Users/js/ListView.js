import lang from "@/views/modules/Users/language/en";

export default {
    name: "list-user",
    
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
            userList: [],
            pagination: {
                currentPage: 0,
                perPage: 0,
                total: 0,
                totalPages: 0
            },
            lang: [],
            records: {
                module: 'UserController',
                ids: [],
            },

        }
    },
    mounted() {
        this.getUsers();
        this.lang = lang;
    },
    methods: {
        changePage(page) {
            const self = this;
            if ((page > 0) && (page <= self.pagination.totalPages) && (page !== self.page)) {
                self.page = page;
                self.getUsers();
            }
        },
        changeSort() {
            const self = this;
            if (self.sort.order === 'asc') {
                self.sort.order = 'desc';
            } else if (self.sort.order === 'desc') {
                self.sort.order = 'asc';
            }
            self.getUsers();
        },
        getUsers() {
            const self = this;
            self.loading = true;
            axios.get('api/modules/users', {
                params: {
                    page: self.page,
                    sort: self.sort,
                    search: self.search,
                    perPage: self.perPage
                }
            }).then(function (response) {
                console.log(response);
                self.userList = response.data.items;
                self.pagination = response.data.pagination;
                if (self.pagination.totalPages < self.pagination.currentPage) {
                    self.page = self.pagination.totalPages;
                    self.getUsers();
                } else {
                    self.loading = false;
                }
            }).catch(function () {
                self.loading = false;
            });
        },
        exportData() {
            const self = this;
            axios.post('api/export', self.records).then(function (response) {
                console.log(response);
                var link = document.createElement('a');
                link.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(response.data);
                // Set the link to download the CSV file
                link.download = 'data.csv';
                // Click the link to trigger the CSV download
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }).catch(function () {
                self.loading = false;
            });
        },
    }
}