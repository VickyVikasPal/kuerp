
<template>
    <div class="container-fluid">
        <div class="row">
           
            <SearchView ref="genericSearch" @searchEvent="parentMethod"></SearchView>

            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>List View</h3>
                        <span class="float-right">
                            <router-link class="btn btn-primary btn-sm rounded-pill"  :to="'/modules/'+modules+'/edit'">
                                Create {{ modules }}
                            </router-link>
                        </span>
                    </div>
                    <div class="card-body">
                          <template v-if="loading">
                               <!-- <loader></loader>!-->
                        </template>
                        <template v-else>
                          <div class="table-responsive">
                            <table class="table table-bordered table-striped m-0 item_table">
                                <thead>
                                    <tr>
                                        <th width="40px">S.No.</th>
                                        <th v-for="(column, index) in tableHead" :key="index"> {{column.label}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, indexprod) in productList" :key="indexprod">
                                        <td>{{ indexprod+1 }}</td>
                                        <td v-for="(column, indexColumn) in tableColumn" :key="indexColumn">
                                        <router-link :to="'/modules/'+tableHead[indexColumn].routePath+'/'+item.id+'/detail'" v-if="tableHead[indexColumn].link==true && tableHead[indexColumn].relatedModule == ''">
                                        {{item[column]}}
                                        </router-link>
                                        <router-link :to="'/modules/'+tableHead[indexColumn].relatedModule+'/'+item[related_id]+'/detail'" v-else-if="tableHead[indexColumn].link==true && tableHead[indexColumn].relatedModule != ''">
                                        {{item[column]}}
                                        </router-link>
                                        <template v-else>{{item[column]}}</template>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </template>
                      
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">

                            <div class="import-file d-flex align-items-center">
                                <select class="form-select form-select-sm me-2" >
                                    <option value="">Select</option>
                                    <option value="all">All Records</option>
                                    <option value="none">None</option>
                                </select>
                                <button class="btn btn-secondary btn-sm">Import</button>
                            </div>

                            
                               

                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            
                              <div class="d-flex justify-content-end align-items-center">
                                    <button
                                        :class="pagination.currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : ''"
                                        :disabled="pagination.currentPage <= 1"
                                        class="pagination-link btn btn-secondary btn-sm"
                                        type="button"
                                        @click="changePage(pagination.currentPage - 1,tableHead,tableColumn)"
                                    >
                                    <i class="fa-solid fa-angle-left"></i>
                                    </button>
                                    <span class="mx-2">
                                        <span>{{ (pagination.perPage * pagination.currentPage) - pagination.perPage + 1 }}</span>
                                        to
                                       <span >{{ pagination.perPage * pagination.currentPage <= pagination.total ? pagination.perPage * pagination.currentPage : pagination.total }}</span>
                                       of
                                        <span>{{ pagination.total }}</span>
                                    </span>
                                    <button
                                        :class="pagination.currentPage >= pagination.totalPages ? 'opacity-50 cursor-not-allowed' : ''"
                                        :disabled="pagination.currentPage >= pagination.totalPages"
                                        class="ml-3 pagination-link btn btn-secondary btn-sm"
                                        type="button"
                                        @click="changePage(pagination.currentPage + 1,tableHead,tableColumn)"
                                    >
                                    <i class="fa-solid fa-angle-right"></i>
                                    </button>
                                </div>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
import {ref} from "vue";
import SearchView from "@/components/layout/shared/SearchView.vue";
//import loader from "@/views/shared/loading/Loading.vue";
export default {
    name:'genericList',
    components:{
        SearchView,
       // loader,
    },
    data() {
        return {
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
            routePath:null,  
            tableHead:[],
            tableColumn:[],
            checked:[],
            modules:null,
            loading:false,
            searchArr:[],
            related_id:'',
        }
    },
    methods: {
        changePage(page,tableHead,tableColumn) {
            const self = this;
            if ((page > 0) && (page <= self.pagination.totalPages) && (page !== self.page)) {
                self.page = page;
                self.loadGenericView(tableHead,tableColumn);
            }
        },
        changeSort() {
            const self = this;
            if (self.sort.order === 'asc') {
                self.sort.order = 'desc';
            } else if (self.sort.order === 'desc') {
                self.sort.order = 'asc';
            }
            self.loadGenericView();
        },
        loadGenericView(metaList,columns,searchar, related_id) {
            
            const self = this;
            self.loading = true;
            self.tableHead = metaList;
            self.tableColumn = columns;
            self.modules = metaList[0].routePath;
            self.related_id = related_id;
            self.searchArr = searchar;
           
            self.$refs.genericSearch.loadGenericSearch(self.searchArr);
            axios.get('/modules/'+self.modules, {
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
                    self.loadGenericView();
                } else {
                    self.loading = false;
                }
            }).catch(function () {
                self.loading = false;
            });
        },
        parentMethod(searchRes){
           const self = this;
           self.search = searchRes;
           self.searchArr
           self.loadGenericView(self.tableHead,self.tableColumn,self.searchArr);
        },

    },

        
}
</script>
