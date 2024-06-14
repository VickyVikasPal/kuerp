import lang from "@/views/modules/Administration/language/en";
import breadcrumbs from "@/views/modules/Administration/MenuList.vue";


export default {
    name: "repair",
    
    components: {
        breadcrumbs,
    },
    data(){
        return {
         lang:[],
         dnone1:'d-none',
         dnone2:'d-none',
         dnone3:'d-none',
         dnone4:'d-none',
         clear:{
             cache:true,
             blade:true,
             optimize:true,
             route:true,
         }
        }
    },
    mounted() {
        this.lang = lang;
    },
    methods: {
        quickRepair(){
            const self = this;
            self.dnone = 'd-none';
            axios.post('modules/quickRepair', self.clear).then(function(response){
                if(self.clear.cache == true){
                    self.dnone1 = 'd-block';
                }
                if(self.clear.blade == true){
                    self.dnone2 = 'd-block';
                }
                if(self.clear.optimize == true){
                    self.dnone3 = 'd-block';
                }
                if(self.clear.route == true){
                    self.dnone4 = 'd-block';
                }
                
            })
        }
    },
    
}