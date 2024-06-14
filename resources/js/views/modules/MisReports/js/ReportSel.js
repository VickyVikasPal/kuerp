import lang from "@/views/modules/MisReports/language/en";
import breadcrumbs from "@/views/modules/MisReports/MenuList.vue";
import reportlist from "@/views/modules/MisReports/js/ReportArray.js";
import Datepicker from 'vuejs3-datepicker';
import loader from "@/views/shared/loading/Loading.vue";

export default {
    name:'report_selection',

    components: {
        breadcrumbs,
        loader,
        Datepicker,       
    },
   data(){
       return {
        lang:[],
        htmlContent:[],
        FormData:{},
        reportName:null,
        pdfUrl:null,
        errorDefine:'',
        showError: false,
        moduleName:null,
       }
   },
    mounted() {
        this.lang = lang;
        this.loadView();
    },
    methods: {
        loadView(){
            const self = this; 
            let report_name = self.$route.query.rname;
            
            for(let i = 0; i < reportlist.report_array.length; i++){
            
                if(reportlist.report_array[i].rname == report_name){
                    self.showError = false;
                    self.pdfUrl = reportlist.report_array[i].rname;
                    self.reportName = reportlist.report_array[i].report_name;
                    self.moduleName = reportlist.report_array[i].module_name;
                    self.htmlContent = reportlist.report_array[i].field_lists;
                    for(let j = 0; j < self.htmlContent.length; j++){
                        if(self.htmlContent[j].function_name !=''){
                           this.reportFunction(self.htmlContent[j].function_name, self.htmlContent[j].name);
                        }
                    }
                }else{
                    console.warn("'rname' Not defined in ReportArray and MisArray");
                   
                }
            }
        },

        customFormatter(date) {
            
            return moment(date).format('DD/MM/yyyy');
        },

       reportFunction(fn_Name, fName){
        
        axios.get('api/modules/custom_function',{params:{'functionName':fn_Name}}).then(function(response){
                     
           for(let i = 0; i < response.data.length; i++){
               
            var option = document.createElement("option");
                option.text = response.data[i].name;
                option.value = response.data[i].id;
                const select_tag = document.getElementById(fName);
                select_tag.dispatchEvent(new Event('change'));
                select_tag.appendChild(option);
           }
         
        }).catch(function(error){
            console.warning("Error")
        });
       },
       generateReport(fileType){
           const self = this;
           
           if(Object.values(self.FormData) == ''){
            alert("please fill forms to generate report");
           }else{
                if(fileType == 'excel'){
                    axios.post('api/generate_report',{
                        'fileType':fileType,
                        'reportName':self.reportName,
                        'formData':self.FormData,
                        'moduleName':self.moduleName
                }).then(function(response){
                    
                    console.log(response);
                        var link = document.createElement('a');
                        link.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(response.data);
                        // Set the link to download the CSV file
                        link.download = self.reportName+'.csv';
                        // Click the link to trigger the CSV download
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    
                }).catch(function(error){
                    console.warning('error');
                });
                }
                if(fileType == 'pdf'){
                    window.open('/mis-report/'+self.pdfUrl+'?reportName='+self.reportName+'&category_id='+self.FormData.category_id+'&dateRange1='+self.FormData.date_range1+'&dateRange2='+self.FormData.date_range2, 'newwindow',);
                }
            }
       }
    },
}
