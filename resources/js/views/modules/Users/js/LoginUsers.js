import breadcrumbs from "@/views/modules/Users/MenuList.vue";
import lang from "@/views/modules/Users/language/en";

export default {
    name: "login-users",
    components: {
        breadcrumbs,
    },
    data() {
        return {
            page: 1,
            search: '',
            sort: {
                order: 'desc',
                column: 'date_modified',
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
            lang:[],
            userList1:[],
        }
    },
    mounted() {
        this.lang = lang;
        this.loadLogInDetail();
        this.loadLogOutDetail();
    },
    methods: {
        changePage(page) {
            const self = this;
            if ((page > 0) && (page <= self.pagination.totalPages) && (page !== self.page)) {
                self.page = page;
                self.loadLogInDetail();
            }
        },
        changeSort() {
            const self = this;
            if (self.sort.order === 'asc') {
                self.sort.order = 'desc';
            } else if (self.sort.order === 'desc') {
                self.sort.order = 'asc';
            }
            self.loadLogInDetail();
        },
        loadLogInDetail(){
            const self = this;
            axios.get('api/modules/users/loggedIn',{
                params: {
                    page: self.page,
                    sort: self.sort,
                    search: self.search,
                    perPage: self.perPage
                }
            }).then(function(response){
                self.userList = response.data.items;
                self.pagination = response.data.pagination;
                    if (self.pagination.totalPages < self.pagination.currentPage) {
                        self.page = self.pagination.totalPages;
                        self.loadLogInDetail();
                    } else {
                        self.loading = false;
                    }
                    
            }).catch(function(error){
                console.log(error);
            })
        },
        loadLogOutDetail(){
            const self = this;
            axios.get('api/modules/users/loggedOut',{
                params: {
                    page: self.page,
                    sort: self.sort,
                    search: self.search,
                    perPage: self.perPage
                }
            }).then(function(response){
                self.userList1 = response.data.items;                    
            }).catch(function(error){
                console.log(error);
            })
        }
    },
  
}