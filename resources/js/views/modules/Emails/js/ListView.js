import lang from "@/views/modules/Emails/language/en";
import breadcrumbs from "@/views/modules/Emails/MenuList.vue";
//import Datepicker from 'vuejs-datepicker';
//import dom_array from "@/components/layout/shared/common/Custom_dom.js";

export default {
    name: "email-list",

    components: {
        breadcrumbs,
        //Datepicker,
    },
    data() {
        return {
            page: 1,
            search: {

            },
            sort: {
                order: 'desc',
                column: 'date_modified',
            },
            perPage: 10,
            loading: true,
            pagination: {
                currentPage: 0,
                perPage: 0,
                total: 0,
                totalPages: 0
            },
            lang: [],
            emailList: [],
           // dom_array: [],
        }
    },
    mounted() {
        this.lang = lang;
       // this.dom_array = dom_array;
        this.getEmails();
    },
    methods: {
        changePage(page) {
            const self = this;
            if ((page > 0) && (page <= self.pagination.totalPages) && (page !== self.page)) {
                self.page = page;
                self.getEmails();
            }
        },
        changeSort() {
            const self = this;
            if (self.sort.order === 'asc') {
                self.sort.order = 'desc';
            } else if (self.sort.order === 'desc') {
                self.sort.order = 'asc';
            }
            self.getEmails();
        },
        getEmails() {
            const self = this;
            axios.get('api/modules/emails', {
                params: {
                    page: self.page,
                    sort: self.sort,
                    search: self.search,
                    perPage: self.perPage
                }
            }).then(function (response) {
                self.emailList = response.data.items;
                self.pagination = response.data.pagination;
                if (self.pagination.totalPages < self.pagination.currentPage) {
                    self.page = self.pagination.totalPages;
                    self.getEmails();
                } else {
                    self.loading = false;
                }

            }).catch(function (error) {
                console.log(error);
            })
        },
        clearSearch() {
            const self = this;
            self.search = {};
            self.$emit('searchEvent', self.res)
            self.getEmails();
        }
    },

}