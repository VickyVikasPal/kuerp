<template>
    <div  class="card mb-2" >
        <div class="card-header d-flex justify-content-between">
            <h3>{{moduleName}}</h3>
        </div>
        <div class="card-body">
    <apexchart :id="moduleName" :type="graphType" :options="options" :series="series" :width="'100%'" :height="'280px;'"></apexchart>
        </div>
        </div>
      
</template>
<script>
import VueApexCharts from 'vue-apexcharts';

export default {
    name:"basic-graph",
     props:{
                moduleName:{
                    type:String
                },
                graphType:{
                    type:String
                },
            },
    data() {
        return {
            options:{},
            series:[],
           }
        },   
   mounted() {
            this.LoadChart(this.moduleName);
        },
        methods: {
            LoadChart(valid){
               const self = this;
                let searchaArray = require(`@/views/modules/${self.moduleName}/dashlets/Graph.js`);

               self.getData(self.moduleName, searchaArray.default.label, searchaArray.default.columns,valid);
               
                },
            getData(moduleName, label, columns, valid){
                const self = this;
                
                axios.get('api/widgets/graphData',{params:{'moduleName':moduleName,'cal_value':label, 'columns':columns}}).then(function(response){
                   //console.log(response);
                   if(self.graphType == 'bar'){
                       self.options = {
                           chart: {
                                id: self.moduleName,
                                },
                                xaxis: {
                                categories: label,
                                },
                                yaxis:{
                                    show:true,
                                },
                       };
                       self.series = [{
                                name: 'series-'+response.data.length,
                                data: response.data
                            }];
                   }

                   if(self.graphType == 'donut'){
                       self.options = {};
                       self.series = response.data;
                   }
                   //self.series[0].name = 'series-'+response.data.length;
                  // self.series[0].data = response.data;
                  // self.options.xaxis.categories = label;
                  
                })
            },
        },
}
</script>
