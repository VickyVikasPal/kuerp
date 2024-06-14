import breadcrumbs from "@/views/modules/Users/MenuList.vue";
import lang from "@/views/modules/Users/language/en";
//import dom_array from "@/components/layout/shared/common/Custom_dom.js";

export default {
    name: "new-user",
    components: {
        breadcrumbs,
    },

    data() {
        return {
            showDropdown: null,
            field_id: null,
            loading: false,
            user: {
                first_name: null,
                last_name: null,
                user_name: null,
                status: null,
                login_status: null,
                phone_mobile: null,
                avatar_path: null,
            },
            lang: [],
            rows: [
                {
                    text: '',
                    radio1: false,
                    radio2: false
                }
            ],
            parentCompnent: null,
            record: null,
            image: null,
            //dom_array: [],
            avatar_preview: null,
            gravatar: null,
            file_content: null,
            fileName: [],
            loading: false,
            showFileName: null,
            preview_image: false,
        }
    },
    mounted() {
        this.lang = lang;
        //this.dom_array = dom_array;
        this.getUser();
        let currentUrl = window.location.origin;
        this.avatar_preview = `${currentUrl}/assets/images`;
        this.user.avatar = this.avatar_preview+"/profile-45x45.png";
    },
    methods: {
        changeFile(e) {
            const self = this;
            this.preview_image = true;
            let image = e.target.files[0];
            let file_type_arr = e.target.files[0].type.split("/");
            this.fileName = file_type_arr;
            this.showFileName = image.name;
            this.avatar_preview = URL.createObjectURL(e.target.files[0]);
            this.user.avatar_preview = URL.createObjectURL(e.target.files[0]);
            
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                self.user.file_content = e.target.result;
                self.user.fileUpload = true;
            };
        },
        addRow() {
            this.rows.push({
                text: '',
                radio1: false,
                radio2: false
            });
        },
        removeRow(index) {
            if (index !== 0) {
                this.rows.splice(index, 1);
            }
        },
        getUser() {
            const self = this;
            self.record = self.$route.params.id;
            if (typeof (self.record) != 'undefined') {
                let record_id = self.record;
                axios.get('api/modules/users/' + self.$route.params.id).then(function (response) {
                    self.user = response.data;
                    self.user.login_status = self.user.login_status == 'Active' ? 1 : 0;
                    self.user.status = self.user.status == 'Active' ? 1 : 0;
                   // self.user.avatar=response.data.avatar_path;
                   // let created_date = (response.data.date_entered).split('-');
                  //  self.avatar_preview = `/uploads/${created_date[2]}/${created_date[1]}`;
                    self.loading = false;
                }).catch(function () {
                    self.loading = false;
                });
            }
        },
        saveUser() {
            const errorMessages = document.getElementsByClassName('error-message');
            while (errorMessages.length > 0) {
                errorMessages[0].remove();
            }
            const self = this;
            self.loading = true;
            const formData = new FormData();
            formData.append('avatar', this.image);
            let fileExt = '';
            if (self.fileName != '') {
                self.user.fileExt = self.fileName[1];
            }
            let editFormData = self.user;
            if (typeof (self.record) == 'undefined' || self.record == '') {
                axios.post('api/modules/users', self.user, formData).then(function (response) {
                    self.loading = false;
                    self.$notify({
                        title: self.$i18n.t('Success').toString(),
                        text: self.$i18n.t('Data saved correctly').toString(),
                        type: 'success'
                    });
                    self.$router.push('/modules/users');
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
                axios.put(`api/modules/users/${self.$route.params.id}`, self.user).then(function (response) {
                    self.loading = false;
                    self.$notify({
                        title: self.$i18n.t('Success').toString(),
                        text: self.$i18n.t('Data update correctly').toString(),
                        type: 'success'
                    });
                    self.$router.push('/modules/users');
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
        openComponent(routeName, moduleName, field_id, queryData = null) {
            this.field_id = field_id;
            this.windowRef = window.open(`/popup?module=${routeName}&body=modal&callback=parentMethod&moduleName=${moduleName}`, "", "width=600,height=400,left=200,top=200");
            this.parentCompnent = routeName;
            this.windowRef.addEventListener('beforeunload', this.parentMethod);

        },
        parentMethod() {
            const module_name = this.parentCompnent.slice(0, -1);
            const parent_id = localStorage.getItem('parentid');
            const parent_name = localStorage.getItem('parentname');
            const parent_type = localStorage.getItem('parenttype');
            this.selectElement(module_name, parent_name, parent_id, parent_type);

            if (this.windowRef) {
                this.windowRef.close();
                this.windowRef = null;
                this.$emit('close');
            }
            localStorage.removeItem('parentid');
            localStorage.removeItem('parentname');
            localStorage.removeItem('parenttype');

        },
        updateItem(id, name, type) {
            this.showDropdown = false;
            const module_name = type;
            this.selectElement(module_name, name, id, type);
        },
        selectElement(moduleName, name = null, id = null, module = null) {

            const module_name = moduleName.replace("-", "_");
            const p_name = module_name + '_name';
            const p_name_el = document.getElementById(p_name);
            console.log(moduleName);
            console.log(name);
            console.log(this.field_id);
            p_name_el.value = name;
            p_name_el.dispatchEvent(new Event('input'));
            const p_id = this.field_id;
            const p_id_el = document.getElementById(p_id);
            p_id_el.value = id;
            p_id_el.dispatchEvent(new Event('input'));
            //this.field_id = null;

        },
        clearComponent(modulesLink) {
            const self = this;
            self.dropdownList = [];
            if (self.dropdownList.length == 0) {
                self.selectElement(modulesLink, '', '', '');
            }
        },
        queryForKeywords(e, modulesLink, field_id) {
            const self = this;
            self.field_id = field_id;
            let searchData = e.target.value;
            let relatedModule = modulesLink + 's';
            self.showDropdown = null;

            if (searchData.length > 1) {
                axios.post(`api/modules/searchItem`, { 'data': searchData, 'relatedModule': relatedModule }).then(function (response) {
                    self.dropdownList = response.data;
                    self.showDropdown = field_id;
                });
            } else {
                self.showDropdown = false;
                self.dropdownList = [];

                if (searchData.length == 0) {
                    self.selectElement(modulesLink, '', '', '');
                }

            }
        },
    }

}