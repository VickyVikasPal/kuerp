<template>
    <div class="card mb-2">
        <div class="card-header"><h3>{{module}}</h3></div>
        <div class="card-body">
            <canvas :id="module" :graphType="graphType"></canvas>
        </div>
    </div>
   
</template>

<script>
    export default {
        name: "bar",
        props:{
                module:{
                    type:String
                },
                graphType:{
                    type:String
                },
            },
            watch: {
                '$props':{
                handler: function (val, oldVal) { 
                    
                    this.LoadChart(val.module);
                 
                },
                deep: true
                }
            },
        data(){
            return {
                moduleName:null,
                graphData:[],
            }
        },
        mounted() {
            this.LoadChart(this.module);
            
        },
        methods: {
            LoadChart(valid){
               const self = this;
                let searchaArray = require(`@/views/modules/${self.module}/dashlets/Graph.js`);

               self.getData(self.module, searchaArray.default.label, searchaArray.default.columns,valid);
               
                },
            getData(moduleName, label, columns, valid){
                const self = this;
                axios.get('api/widgets/graphData',{params:{'moduleName':moduleName,'cal_value':label, 'columns':columns}}).then(function(response){
                   //console.log(response);
                   self.graphData = response.data;
                  self.loadGraph(label, valid, columns);
                })
            },
            loadGraph(label, valid, columns){
                const self = this;
                    let ctx = document.getElementById(valid);
                   // console.log(self.graphType);
                   let genericChart = new Chart(ctx, {
                            type: self.graphType,
                            data: {
                                labels: label,
                                datasets: [{
                                    label: columns+' Count',
                                    data: self.graphData,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                            }
                    });
            }
        },
    }
</script>
<style>
    canvas{height:320px}
</style>
