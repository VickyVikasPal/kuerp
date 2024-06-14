import breadcrumbs from "@/views/modules/BulkInventorys/MenuList.vue";
import lang from "@/views/modules/BulkInventorys/language/en";

export default {
    name: "new-bulk-invnetorys",
    components: {
        breadcrumbs,
    },
    data() {
        return {
            loading: true,
            lang:[],
            csvFile:"csvFile",
            name: '',
            file: '',
            success: '',
        }
    },
    mounted() {
        this.checkPermisson();
        this.lang = lang;
    },
    methods: {
       
        uploadCSV(){
            const self = this; 

            this.file = self.$refs.csvfile.files[0];
            let lines = "";
            let currentline = "";
            let csv = "";
            let headers = "";
            let result = [];
            let reader = new FileReader();
            reader.readAsBinaryString(self.$refs.csvfile.files[0]);
            reader.onload = evt =>{
                csv = reader.result;
               
                lines = csv.split("\r" + "\n");
                headers = lines[0].split(",");
               
                for(var i = 1; i < (lines.length-1); i++){
                   
                        let rowData = {};
                        currentline = lines[i];
                        let re = /"/g;
                        currentline = re[Symbol.replace](currentline,'');
                        currentline = currentline.split(",");
                        
                        for(let j = 0; j < headers.length; j++){
                            let head = headers[j].trim();
                            let value = currentline[j];
                            
                            rowData[head] = value;
                        }
                      
                        result.push(rowData);
                      
                    //}
                }
               // console.log(result);
                self.uploadFile(result)
            }
           
           
        },
        uploadFile(filesData){
          const self = this;           
        axios.post('/modules/bulkinventorys/uploads',{'fileData':filesData})
                .then(function (res) {
                    self.success = res.data.message;
                    alert(self.success);
                    self.$router.push('/modules/bulkinventorys');
                })
                .catch(function (err) {
                    self.output = err;
                });
        },
        checkPermisson() {
            const self = this;
            self.loading = false;
        },
    }
}