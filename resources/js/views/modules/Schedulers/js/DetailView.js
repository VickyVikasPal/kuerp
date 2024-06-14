import breadcrumbs from "@/views/modules/Schedulers/MenuList.vue";
import lang from "@/views/modules/Schedulers/language/en";

export default {
    name: "edit-scheduler",
    components: {
        breadcrumbs,
    },
    data() {
        return {
            loading: true,
            isActive: false,
            lang: [],
            schedulerId: '',
            scheduler: {

            },
            schedulerList:[],
            page: 1,
            search: '',
            sort: {
                order: 'desc',
                column: 'date_entered',
            },
            perPage: 10,
            pagination: {
                currentPage: 0,
                perPage: 0,
                total: 0,
                totalPages: 0
            },
            
        }
    },
    created() {
        this.schedulerId = this.$route.params.id;
    },
    mounted() {
        this.lang = lang;
        this.getScheduler();
        this.getSchedulerStatus();
    },
    methods: {
        openAction() {
            this.isActive = !this.isActive;
        },
        getScheduler() {
            const self = this;
            self.loading = true;
            axios.get('api/modules/schedulers/' + self.$route.params.id).then(function (response) {
                self.scheduler = response.data;
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },

         getSchedulerStatus() {
            const self = this;
            self.loading = true;
            self.search = [{'scheduler_id':self.$route.params.id}];
            axios.post('api/schedulers/getStatus',{
            params: {
                page: self.page,
                sort: self.sort,
                search: self.search,
                perPage: self.perPage
            }}
            ).then(function (response) {
                self.schedulerList = response.data.items.data;
                
                self.pagination = response.data.pagination;
                if (self.pagination.totalPages < self.pagination.currentPage) {
                    self.page = self.pagination.totalPages;
                    self.getSchedulerStatus();
                } else {
                    self.loading = false;
                }
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        changePage(page) {
            const self = this;
            if ((page > 0) && (page <= self.pagination.totalPages) && (page !== self.page)) {
                self.page = page;
                self.getSchedulerStatus();
            }
        }, 
    }
}