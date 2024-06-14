<template>
    <div class="container-fluid">

        <SearchView ref="genericSearch" @searchEvent="parentMethod"></SearchView>
        
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                         <tr>
                            <td><input type="checkbox" value="checkall"/></td>
                            <th v-for="(column, index) in tableHead" :key="index"> {{column.label}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, indexprod) in productList" :key="indexprod">
                                <td><input type="checkbox" v-model="checked[item.id]" :value="item.id" :checked="''"/></td>
                                <td v-for="(column, indexColumn) in tableColumn" :key="indexColumn">
                                <a :href="'#'" v-if="tableHead[indexColumn].link==true" @click="send_back(routeName,item.id,item.name)" ref="setParent">
                                {{item[column]}}
                                </a>
                                <template v-else>{{item[column]}}</template>
                                </td>
                            </tr>
                    </tbody>
                    
                </table>
            </div>
            <div class="col-12 text-end">
                 <div class="hidden sm:block">
                            <p class="text-sm leading-5 text-gray-700">
                                {{ 'Showing' }}
                                <span class="font-medium">{{ (pagination.perPage * pagination.currentPage) - pagination.perPage + 1 }}</span>
                                {{'to' }}
                                <span class="font-medium">{{ pagination.perPage * pagination.currentPage <= pagination.total ? pagination.perPage * pagination.currentPage : pagination.total }}</span>
                                {{'of' }}
                                <span class="font-medium">{{ pagination.total }}</span>
                                {{'results' }}
                            </p>
                        </div>
                        <div class="flex-1 d-flex justify-between sm:justify-end">
                        <button
                            :class="pagination.currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : ''"
                            :disabled="pagination.currentPage <= 1"
                            class="pagination-link"
                            type="button"
                            @click="changePage(pagination.currentPage - 1,tableHead,tableColumn)"
                        >
                            {{'Previous' }}
                        </button>
                        <button
                            :class="pagination.currentPage >= pagination.totalPages ? 'opacity-50 cursor-not-allowed' : ''"
                            :disabled="pagination.currentPage >= pagination.totalPages"
                            class="ml-3 pagination-link"
                            type="button"
                            @click="changePage(pagination.currentPage + 1,tableHead,tableColumn)"
                        >
                            {{'Next' }}
                        </button>
                        </div>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from "vue";
import SearchView from "@/components/layout/shared/common/SearchView.vue";

export default {
    name:'popup',
     components:{
        SearchView,
    },
    data() {
        return {
            routeName:null,
            callBack:null,
            tableHead:[],
            tableColumn:[],
            checked:[],
            page: 1,
            search:[],
            sort: {
                order: 'desc',//desc=asc
                column: 'date_entered',
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
        }
    },
    mounted() {
        this.getUrls();
        this.loadPopupSearch();
        this.loadPopupView();
    },
    methods:{
        changePage(page,tableHead,tableColumn) {
            const self = this;
            if ((page > 0) && (page <= self.pagination.totalPages) && (page !== self.page)) {
                self.page = page;
                self.loadPopupView(tableHead,tableColumn);
            }
        },
        changeSort() {
            const self = this;
            if (self.sort.order === 'asc') {
                self.sort.order = 'desc';
            } else if (self.sort.order === 'desc') {
                self.sort.order = 'asc';
            }
            self.loadPopupView();
        },
    
        loadPopupSearch(){
            const self = this;
            import (`../../../../views/modules/${self.moduleName}/metaview/metajs/SearchView.js`).then(function(response){
                console.log(response.default);
                self.$refs.genericSearch.loadGenericSearch(response.default);
            });;
            
        },
        getUrls(){
            const urlSearchParams = new URLSearchParams(window.location.search);
            const params = Object.fromEntries(urlSearchParams.entries());
            this.routeName = params.module;
            this.moduleName = params.moduleName;            
            
            this.callBack = params.callback;
           
        },

         parentMethod(searchRes){
           const self = this;
           self.search = searchRes;
           self.loadPopupView(self.tableHead,self.tableColumn,self.searchArr);
        },
        loadPopupView(){
            const self = this;
            const searchField = import(`../../../../views/modules/${self.moduleName}/metaview/metajs/PopupField.js`).then(function(response){
                self.tableHead = response.default.metaList;
                self.tableColumn = response.default.columns;
            });
            self.routeName = self.routeName.toLowerCase()
            axios.get('modules/'+self.routeName, {
                params: {
                    page: self.page,
                    sort: self.sort,
                    search: self.search,
                    perPage: self.perPage
                }
            }).then(function (response) {
                self.productList = response.data.items;
                self.pagination = response.data.pagination;
                if (self.pagination.totalPages < self.pagination.currentPage) {
                    self.page = self.pagination.totalPages;
                    self.loadPopupView();
                } else {
                    self.loading = false;
                }
            }).catch(function () {
                self.loading = false;
            });
        },
        send_back(routeName, module_id, name){
            const modules = routeName.slice(0, -1);
            localStorage.setItem('parentid',module_id);
            localStorage.setItem('parenttype', modules);
            localStorage.setItem('parentname', name);
            window.close();
        }
    }
}
</script>
