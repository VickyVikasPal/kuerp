import lang from "@/views/modules/Emails/language/en";
import breadcrumbs from "@/views/modules/Emails/MenuList.vue";

export default {
    name: "email-edit",

    components: {
        breadcrumbs,
    },
    data() {
        return {
            emails: {

            },
            lang: [],
            record: null,
            fieldValue: null,
        }
    },
    mounted() {
        this.lang = lang;
        this.getEmail();
    },
    methods: {
        getEmail() {
            const self = this;
            axios.get('api/modules/emails/getEmailSettingValue').then(function (response) {
                if (response.data != '' && response.data != 'null') {
                    self.emails = response.data;
                }
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        saveEmail() {
            const errorMessages = document.getElementsByClassName('error-message');
            while (errorMessages.length > 0) {
                errorMessages[0].remove();
            }
            const self = this;
            self.loading = true;
            let fieldValue = document.getElementById('fieldValue').value;
            if (typeof (self.fieldValue) == 'undefined' || fieldValue == '') {
                axios.post('api/modules/emails', self.emails).then(function (response) {
                    self.loading = false;
                    self.$notify({
                        title: self.$i18n.t('Success').toString(),
                        text: self.$i18n.t('Data saved correctly').toString(),
                        type: 'success'
                    });
                    self.$router.push('/modules/emails');
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
            } else {
                axios.put(`api/modules/emails/${fieldValue}`, self.emails).then(function (response) {
                    self.loading = false;
                    self.$notify({
                        title: self.$i18n.t('Success').toString(),
                        text: self.$i18n.t('Data update correctly').toString(),
                        type: 'success'
                    });
                    self.$router.push('/modules/emails');
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
    },

}