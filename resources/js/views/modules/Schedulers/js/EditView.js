
import lang from "@/views/modules/Schedulers/language/en";
import dom_array from "@/components/layout/shared/common/Custom_dom.js";
export default {
    name: "add-scheduler",

    components: {

    },
    data() {
        return {
            lang: [],
            scheduler: {

            },
            record: null,
            job_array: [],
            dom_array: [],
            numbers: [],
        }
    },
    mounted() {
        this.lang = lang;
        this.dom_array = dom_array;
        this.getSchedulerJobString();
        this.getScheduler();
        this.populateNumbers();
    },
    methods: {
        populateNumbers() {
            const self = this;
            for (let i = 1; i <= 30; i++) {
                self.numbers.push(i);
            }
        },
        getSchedulerJobString() {
            const self = this;
            axios.get('api/modules/schedulers/job-strings').then(function (response) {
                self.job_array = response.data;
                console.log(self.job_array);
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        getScheduler() {
            const self = this;
            self.record = self.$route.params.id;
            if (typeof (self.record) != 'undefined') {
                self.showpassfiled = false;
                let record_id = self.record;
                axios.get('api/modules/schedulers/' + self.$route.params.id).then(function (response) {
                    self.scheduler = response.data;
                    self.loading = false;
                }).catch(function () {
                    self.loading = false;
                });
            }
        },
        saveScheduler() {
            const errorMessages = document.getElementsByClassName('error-message');
            while (errorMessages.length > 0) {
                errorMessages[0].remove();
            }
            const self = this;
            self.loading = true;
            console.log(self.record);

            if (typeof (self.record) == 'undefined' || self.record == '') {
                axios.post('api/modules/schedulers', self.scheduler).then(function (response) {
                    self.loading = false;
                    self.$notify({
                        title: self.$i18n.t('Success').toString(),
                        text: self.$i18n.t('Data saved correctly').toString(),
                        type: 'success'
                    });
                    self.$router.push('/modules/schedulers');
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
                axios.put(`api/modules/schedulers/${self.$route.params.id}`, self.scheduler).then(function (response) {
                    self.loading = false;
                    self.$notify({
                        title: self.$i18n.t('Success').toString(),
                        text: self.$i18n.t('Data update correctly').toString(),
                        type: 'success'
                    });
                    self.$router.push('/modules/schedulers');
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
}