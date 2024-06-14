<template>
   <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-2">
                        <div class="card-header"><h3>Details View</h3></div>
                        <div class="card-body">
                            <template v-if="loading">
                                <loader></loader>
                            </template>
                            <template v-else>
                             <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12" v-for="(column, index) in tableHead" :key="index">
                                    <table  class="table m-0 detail-item-table" >
                                        <tr v-for="(item, item_index) in column.items" :key="item_index">
                                            <td class="w-30 label"> {{item.label}}</td>
                                            <td>:</td>
                                            <td  class="w-70" v-if="item.radiotype==true">
                                                <span v-if="product[item.name] == 1">Yes</span>
                                                <span v-else-if="product[item.name] == 0">No</span>
                                                <span v-else></span>
                                            </td>
                                             <td  class="w-70" v-else-if="item.checkboxtype==true">
                                                <span v-if="product[item.name] == 1">
                                                    <input type="checkbox" checked="true" disabled="disabled">
                                                </span>
                                                <span v-else-if="product[item.name] == 0">
                                                    <input type="checkbox" disabled="disabled">
                                                </span>
                                                <span v-else></span>
                                            </td>

                                             <td  class="w-70" v-else-if="item.is_image==true">
                                                    <img
                                                        :src="product[item.name]"
                                                        alt="image Preview"
                                                        class="avatar-img"
                                                        style="width: 60px;height: 60px;"
                                                    />
                                             </td>

                                             <td class="w-70" v-else-if="item.link==true">
                                                <router-link :to="'/modules/'+item.routePath+'/'+product[item.related_id]+'/detail'">
                                                    {{product[item.name]}}
                                                </router-link>
                                            </td>
                                            <td class="w-70" v-else> {{product[item.name]}}</td>
                                        </tr>
                                    </table>

                                </div>

                            </div>
                            </template>
                           
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" v-if="showSubPanel">
                <div class="col-12">
                    <div class="card mb-2">
                        <div>
                            <ul class="nav nav-tabs mb-2 OuterSubNavTabs" id="subpanel_list">
                                <template v-for="list in linkModule">
                                <li class="nav-item active" id="list.moduleName" v-if="list.moduleName == linkPath">
                                <a class="nav-link active" data-toggle="tab" href="javascript:void(0)" @click="showSubpanel(list.moduleName)">{{list.moduleName}}</a>
                                </li>
                                <li class="nav-item" id="list.moduleName" v-else>
                                <a class="nav-link" data-toggle="tab" href="javascript:void(0)" @click="showSubpanel(list.moduleName)">{{list.moduleName}}</a>
                                </li>
                                </template>
                            </ul>
                        </div>
                        <div class="card-body">
                        
                            <div class="table-responsive">
                               
                                <template>
                                   <!-- <subpanelList ref="loadSubpanel"></subpanelList>!-->
                                </template>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </main>
</template>

<script>
import loader from "@/views/shared/loading/Loading.vue";
//import subpanelList from "@/components/layout/common/common/SubPanelLists.vue";

export default {
    name:'genericDetail',
    components: {
        loader,
       // subpanelList,
    },
    data() {
        return {
            loading: true,
            deleteProductModal: false,
            product:[],
            tableHead:[],
            record:null,
            modules:null,
            image_preview:null,
            loading:false,
            showSubPanel:true,
            linkModule:[],
            linkPath:'',
        }
    },
    methods: {
           loadGenericView(metaList,routePath, linkModule = []) {
            const self = this;
            self.loading = true;
            self.tableHead = metaList;
            self.record = self.$route.params.id;
            self.modules = routePath.path;
            self.linkModule = linkModule;
            if(linkModule.length > 0){
                self.showSubPanel = linkModule[0].showSubpanel;
               
            }else{
                self.showSubPanel = false;
            }
            
            axios.get(`/modules/${self.modules}/${self.$route.params.id}`).then(function (response) {
                self.product = response.data;
               /*  let created_date = (response.data.date_entered).split('-');
                self.image_preview = `${created_date[0]}/${created_date[1]}`; */
                
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });

            if(self.showSubPanel == true)//loadSubpanel
            {
                self.showSubpanel(linkModule[0].moduleName);
                
            }
        },
        deleteProduct() {
            const self = this;
            axios.delete(`/modules/${self.modules}/${self.$route.params.id}`).then(function () {
                self.$notify({
                    title: self.$i18n.t('Success').toString(),
                    text: self.$i18n.t('Data deleted successfully').toString(),
                    type: 'success'
                });
                self.$router.push(`/modules/${self.modules}`);
            }).catch(function () {
                self.loading = false;
                self.deleteProductModal = false;
            });
        },
      showSubpanel(mname, frmType = ''){
          const self = this;
          self.$refs.loadSubpanel.loadListData(mname, frmType);
          self.linkPath = mname;
      },
       showSubpanelForm(mname, frmType = ''){
          const self = this;
          self.$refs.loadSubpanel.loadListData(mname, frmType);
          self.linkPath = mname;
      },      
    }
}
</script>
