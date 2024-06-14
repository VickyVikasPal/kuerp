import lang from "@/views/modules/UserDashlets/language/en";

//import dom_array from "@/components/layout/shared/common/Custom_dom.js";

export default {
    name: "create-userdashlet",
   
    components: {
       
    },
    data() {
        return {
            loading: true,
            dom_array:[],
            lang:[],
            user:{
                user_type:null,
                module:null,
                graph:null,
                table:null,
                record:null,
                leftWidth:null,
                rightWidth:null,
            },
            disabled:true,
        }
    },
    mounted() {
        this.lang = lang;
        //this.dom_array = dom_array;
        this.getUserDashlet();
    },
    methods: {
        saveUserDashlet(){
            const self = this;
                axios.post('api/modules/userdashlets', self.user).then(function (response) {
                    self.$router.push('/modules/userdashlets');
                }).catch(function () {
                    localStorage.removeItem('Errors');
                });
        },
        getUserDashlet(){
            const self = this;
            self.user.record = self.$route.params.id;

            if (typeof (self.user.record) != 'undefined') {
                let record_id = self.user.record;
                axios.get('api/modules/userdashlets/' + self.$route.params.id).then(function (response) {
                   // self.user = response.data;
                    self.user.user_type = response.data.user_type;
                    self.user.module = response.data.name;
                    self.user.graph = response.data.graph_view == 'Enabled' ? 1 : 0;
                    self.user.table = response.data.table_view == 'Enabled' ? 1 : 0;
                    //self.user.graph = self.user.table_view == 'Active' ? 1 : 0;
                    self.loading = false;
                }).catch(function () {
                    self.loading = false;
                });
            }
        },
        enableGraphType(){
            let gt = document.getElementById('gType');
            if(gt.checked == true){
                this.disabled = false;
            }else{
                this.disabled = true;
            }
        }
        
    }
}