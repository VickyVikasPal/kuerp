<template>
    <main>

        <div class="row mb-2" v-show="showBTN">
            <div class="col-xl-6 col-lg-6 col-md-6 text-left">
                <a class="btn btn-primary btn-sm rounded-pill" data-toggle="tab" href="javascript:void(0)" @click="loadListData(moduleName, 'AddNew')">Add {{moduleName}}</a>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 text-end">
                <button :class="pagination.currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : ''"
                    :disabled="pagination.currentPage <= 1"
                    class="pagination-link btn btn-secondary btn-sm" type="button"
                    @click="changePage(pagination.currentPage - 1,listData)">
                    <i class="fa-solid fa-angle-left"></i>
                </button>
                <span class="mx-2">
                    <span>{{ (pagination.perPage * pagination.currentPage) - pagination.perPage + 1
                        }}</span>
                    {{ $t('to') }}
                    <span>{{ pagination.perPage * pagination.currentPage <= pagination.total ?
                            pagination.perPage * pagination.currentPage : pagination.total }}</span>
                            {{ $t('of') }}
                            <span>{{ pagination.total }}</span>
                    </span>
                
                <button
                    :class="pagination.currentPage >= pagination.totalPages ? 'opacity-50 cursor-not-allowed' : ''"
                    :disabled="pagination.currentPage >= pagination.totalPages"
                    class="ml-3 pagination-link btn btn-secondary btn-sm" type="button"
                    @click="changePage(pagination.currentPage + 1,listData)">
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            </div>
        </div>
           
    <div class="table-responsive" v-if="showList">
        <table v-if="showList" class="table table-bordered table-striped m-0 item_table">
            <thead>
                <tr>
                    <th v-for="listHead in listData">{{listHead.label}}</th>
                </tr>
            </thead>
            <tbody>
             <template v-if="loading">
                <loader></loader>
            </template>
            <template v-else>
                <tr v-for="data in dataList">
                    <template v-for="listHead in listData">
                    <td v-if="listHead.link == true"><router-link :to="'/modules/'+path+'/'+data.id+'/detail'">{{data[listHead.name]}}</router-link></td>
                    <td v-else>{{data[listHead.name]}}</td>
                    </template>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
      
        <!-- <template v-show="showForm">!-->
            <subpanelForm v-show="showForm" ref="loadNewForm" @force-render="forceRender"></subpanelForm>
        <!-- </template> !-->
       
    </main>
</template>
<script>
import loader from "@/views/shared/loading/Loading.vue";
import subpanelForm from "@/components/layout/shared/common/SubPanelForms.vue";

export default {
    name:"generic-sub-panel",
    components:{
        loader,
        subpanelForm
    },
    data(){
        return {
            listData:null,
            showList:false,
            showForm:false,
            path:'',
            page: 1,
            search: [],
            sort: {
                order: 'desc',//desc=asc
                column: 'date_entered',
            },
            perPage: 5,
            loading: true,
            dataList: [],
            pagination: {
                currentPage: 0,
                perPage: 0,
                total: 0,
                totalPages: 0
            },
            moduleName:'',
            showBTN:true,
        }
    },
    mounted() {
       
    },
    methods: {
        loadListData(lists, frmType){
            const self = this;
            self.path = lists.toLowerCase();
            self.moduleName = lists;
            if(frmType ==''){
                self.showForm = false;
           ////resources/js/views/modules/StateLists/metaview/metajs/SubPanelList.js
                import(`@/views/modules/${lists}/metaview/metajs/SubPanelList.js`).then(function(res){
                    self.showTable(res.default);
                });
                
            }
            if(frmType == 'AddNew'){
                self.showList = false;
                self.showForm = true;
                self.showBTN = false;
                //console.log(self.$refs.loadNewForm);
                self.$refs.loadNewForm.loadNewFormData(lists, frmType);
            }
           
        },
        showTable(tableList){
            const self = this;
            self.listData = tableList;
            self.showList = true;
            self.showForm = false;
            self.showBTN = true;
            let moduleName = self.path;
                moduleName = moduleName.toLowerCase();
                self.loading = true;
            axios.get('api/modules/' + moduleName, {
                    params: {
                        page: self.page,
                        sort: self.sort,
                        search: self.search,
                        perPage: self.perPage
                    }
                }).then(function (response) {
                    self.dataList = response.data.items;
                    self.pagination = response.data.pagination;
                    if (self.pagination.totalPages < self.pagination.currentPage) {
                        self.page = self.pagination.totalPages;
                        self.loading = false;
                        //self.loadGenericView();
                    } else {
                        self.loading = false;
                    }
                }).catch(function () {
                    self.loading = false;
                });
        },
        changePage(page, listData){
                const self = this;
                if ((page > 0) && (page <= self.pagination.totalPages) && (page !== self.page)) {
                    self.page = page;
                    self.showTable(listData);
                }
        },
        forceRender(lists, frmType = ''){
            const self = this;
            self.moduleName = lists;
           if(frmType ==''){
                self.showForm = false;
           ////resources/js/views/modules/StateLists/metaview/metajs/SubPanelList.js
                import(`@/views/modules/${lists}/metaview/metajs/SubPanelList.js`).then(function(res){
                    self.showTable(res.default);
                });
                
            }
        },  
          
    },
}
</script>
