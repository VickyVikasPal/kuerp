import lang from "@/views/modules/Administration/language/en";
import breadcrumbs from "@/views/modules/Administration/MenuList.vue";

export default {
    name: "global-setting",
    
    components: {
        breadcrumbs,
    },
    data(){
        return {
         lang:[],
         global_data:[],
         status_value:[],
         msg:'',
         showData:false,
        }
    },
    mounted() {
        this.lang = lang;
        this.getGlobalSettings();
    },
    methods: {
        getGlobalSettings(){
            const self = this;
            axios.post('modules/administration/getglobal',{'getglobal':'globalsettings'}).then(function(response){
                self.global_data = response.data;
                self.status_value = response.data;
                self.showData = true;
            }).catch(function(error){

            });
        },
        saveGlobal(){
            const self = this;
            
            axios.post('modules/administration/updateglobal', self.status_value).then(function(response){
                //console.log(response);
                self.msg = response.data.message;
                setTimeout(self.clearMsg, 1000);
            }).catch(function(error){
                console.log('error');
            })
        },
        clearMsg(){
            const self = this;
            self.msg = '';
            self.resetGlobaleSettings();
        },
        resetGlobaleSettings(){
            const self = this;
            axios.post('modules/administration/resetglobal', {'reset':true}).then(function(response){
                self.getGlobalSettings();
            }).catch(function(error){
                console.log('error');
            })
        }
    },    
}