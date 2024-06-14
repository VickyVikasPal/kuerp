import breadcrumbs from "@/views/modules/Accounts/MenuList.vue";
import lang from "@/views/modules/Accounts/language/en";
export default {
    name: "Account",

    components: { breadcrumbs },
    mounted() {
        this.getUser();
        this.lang = lang;
    },
    data() {
        return {
            account: {
                first_name: null,
                current_password: null,
                password: null,
                password_confirmation: null,
            },
            lang: [],
            avatar_preview: null,
            gravatar: null,
            file_content: null,
            fileName: [],
            loading: false,
            showFileName: null,
            preview_image: false,
            msg: '',
            msgpass: '',
        }
    },
    mounted() {
        this.lang = lang;
        let currentUrl = window.location.origin;
        this.avatar_preview = `${currentUrl}/assets/images`;
        this.account.avatar = this.avatar_preview + "/profile-45x45.png";
        this.getUser();
    },
    methods: {
        changeFile(e) {
            const self = this;
            this.preview_image = true;
            let image = e.target.files[0];
            let file_type_arr = e.target.files[0].type.split("/");
            this.fileName = file_type_arr;
            this.showFileName = image.name;
            self.account.avatar_path = URL.createObjectURL(e.target.files[0]);
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                self.account.file_content = e.target.result;
                self.account.fileUpload = true;
            };
        },
        getUser() {
            const self = this;
            self.loading = true;
            axios.get('/modules/account/show').then(function (response) {
                self.account.first_name = response.data.first_name;
                self.account.last_name = response.data.last_name;
                self.account.avatar_path = response.data.avatar_path;
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        clearMsg() {
            const self = this;
            self.msg = '';
            self.msgpass = '';
        },
        editUser() {
            const errorMessages = document.getElementsByClassName('error-message');
            while (errorMessages.length > 0) {
                errorMessages[0].remove();
            }
            const self = this;
            self.loading = true;
            if (self.fileName != '') {
                self.account.fileExt = self.fileName[1];
            }
            axios.post('/modules/account/update', self.account).then(function (response) {
                self.loading = false;
                self.msg = response.data.message;
                setTimeout(self.clearMsg, 1000);
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
        },
        changePassword() {
            const self = this;
            const errorMessages = document.getElementsByClassName('error-message');
            while (errorMessages.length > 0) {
                errorMessages[0].remove();
            }
            axios.post('/modules/account/password', {
                current_password: self.account.current_password,
                password: self.account.password,
                password_confirmation: self.account.password_confirmation,
            }).then(function (response) {
                self.msgpass = response.data.message;
                setTimeout(self.clearMsg, 1000);
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
    }
}