import lang from "@/views/modules/Administration/language/en";
import breadcrumbs from "@/views/modules/Administration/MenuList.vue";

export default {
    name: "system-setting",

    components: {
        breadcrumbs,
    },
    data() {
        return {
            lang: [],
            loading: true,
            system: {

            },
            record: null,
        }
    },
    mounted() {
        this.lang = lang;
        this.getSystemSetting();
    },
    methods: {
        getSystemSetting() {
            const self = this;
            axios.get('modules/administration/system-values').then(function (response) {
                if (response.data != '' && response.data != 'null') {
                    let system_data = response.data;
                    let dynamicProperties = {};
                    system_data.map(item => {
                        const key = `${item.name}`;
                        dynamicProperties[key] = item.value=='0'?0:item.value;
                    });
                    self.system = dynamicProperties;
                }
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        saveSystemSetting() {
            const errorMessages = document.getElementsByClassName('error-message');
            while (errorMessages.length > 0) {
                errorMessages[0].remove();
            }
            const self = this;
            self.loading = true;
            axios.post('modules/administration/systemsettings', self.system).then(function (response) {
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