<template>
    <main>
            <div  class="card mb-2" >
                <div class="card-header d-flex justify-content-between">
                    <h3>{{module}}</h3>
                    <div class="dropdown dashlet-dropdown">
                        <i class="fa-solid fa-circle-info dropdown-toggle" data-bs-toggle="dropdown"></i>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Edit</a></li>
                            <li><a class="dropdown-item" href="#">Refresh</a></li>
                            <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <template v-if="loading">
                        <loader></loader>
                    </template>
                    <template v-else>
                        <div class="table-reponsive">
                            <table class="table table-bordered table-striped m-0 item_table">
                                <thead>
                                    <tr>
                                        <th v-for="headItem in listHead">{{headItem.label}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, indexprod) in dataList" :key="indexprod">
                                        <td v-for="(column, indexColumn) in columns" :key="indexColumn">
                                            <router-link
                                                :to="'/modules/'+listHead[indexColumn].routePath+'/'+item.id+'/detail'"
                                                v-if="listHead[indexColumn].link==true">
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
            </div>
        

    </main>
</template>
<script>
    import { ref } from "vue";
    import loader from "@/views/shared/loading/Loading.vue";    
 
    export default {
        name: 'genericDashletTable',
        props:{
            module,
        },
        watch: {
                '$props':{
                handler: function (val) { 
                    
                    this.loadDashlet();
                },
                deep: true
                }
            },
        components:{
        loader,
       },
        data() {
            return {
                loading:false,
                dataList:[],
                listHead:[],
                columns:[],
            }
        },
        mounted() {
            this.loadDashlet();
        },
        methods: {
            loadDashlet(){
               
                let searchaArray = require(`@/views/modules/${this.module}/dashlets/Table.js`);
                this.columns = searchaArray.default.columns;
                this.listHead = searchaArray.default.metaList;
                this.loadData(searchaArray);
            },
            loadData(listArray){
                const self = this;
                self.loading = true;
                axios.get('api/widgets/getDashletTable',
                {params:{
                    'moduleName':self.module,
                    'listName':self.columns
                }
            }).then(function(response){
                self.dataList = response.data;
                self.loading = false;
            }).catch(function(error){
                console.log('error');
            })
            }
        },


    }
</script>