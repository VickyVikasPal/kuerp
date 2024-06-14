import lang from "@/views/modules/Administration/language/en";
import breadcrumbs from "@/views/modules/Administration/MenuList.vue";
//import dom_array from "@/components/layout/shared/common/Custom_dom.js";

export default {
    name: "local-setting",
    
    components: {
        breadcrumbs,
    },
    data(){
        return {
            lang: [],
            loading: true,
            local: {

            },
            record: null,
           // dom_array:[],
        }
    },
    mounted() {
        this.lang = lang;
       // this.dom_array = dom_array;
        this.getLocalSetting();
    },
    methods: {
        getLocalSetting() {
            const self = this;
            axios.get('modules/administration/local-values').then(function (response) {
                if (response.data != '' && response.data != 'null') {
                    let local_data = response.data;
                    let dynamicProperties = {};
                    local_data.map(item => {
                        const key = `${item.name}`;
                        dynamicProperties[key] = item.value=='0'?0:item.value;
                    });
                    self.local = dynamicProperties;
                    console.log(self.local.calculate_response_time);
                }
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        saveLocalSetting() {
            const errorMessages = document.getElementsByClassName('error-message');
            while (errorMessages.length > 0) {
                errorMessages[0].remove();
            }
            const self = this;
            self.loading = true;
            axios.post('modules/administration/localsettings', self.local).then(function (response) {
                self.loading = false;
            }).catch(function () {
                self.loading = false;
                let err = localStorage.getItem('Errors');
                let err_msg = (JSON.parse(err));
                let err_msg2 = err_msg.errors;
                Object.keys(err_msg2).forEach((key) => {
                    let errorval = err_msg2[key];
                    const input = document.getElementById(key);
                    const errorDiv = document.createElement('span');
                    errorDiv.className = 'error-message error';
                    errorDiv.textContent = errorval;
                    input.insertAdjacentHTML('afterend', errorDiv.outerHTML);
                });
                localStorage.removeItem('Errors');
            });
        }
    },
    
}