import lang from "@/views/modules/Administration/language/en";
import breadcrumbs from "@/views/modules/Administration/MenuList.vue";
//import dom_array from "@/components/layout/shared/common/Custom_dom.js";

export default {
    name: "pdf-setting",

    components: {
        breadcrumbs,
    },
    data() {
        return {
            lang: [],
            loading: true,
            pdf: {
                avatar_path: null,
            },
            record: null,
           // dom_array: [],
            imagePreviews: {},
            avatar_preview: null,
            gravatar: null,
            file_content: null,
            fileName: [],
            loading: false,
            showFileName: null,
            preview_image: false,
            upload_logo_previewImg: '',
            upload_nabh_logo_previewImg: '',
            upload_login_logo_previewImg: '',
            login_background_previewImg: '',
            manualPath: 'upload',
        }
    },
    mounted() {
        this.lang = lang;
        //this.dom_array = dom_array;
        this.getPdfSetting();
    },
    methods: {
        getPdfSetting() {
            const self = this;
            axios.get('modules/administration/pdf-values').then(function (response) {
                if (response.data != '' && response.data != 'null') {
                    let pdf_data = response.data;
                    let dynamicProperties = {};
                    pdf_data.map(item => {
                        const key = `${item.name}`;
                        dynamicProperties[key] = item.value == '0' ? 0 : item.value;
                    });
                    self.pdf = dynamicProperties;
                  console.log(self.pdf.calculate_response_time);
                }
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        savePdfSetting() {
            const errorMessages = document.getElementsByClassName('error-message');
            while (errorMessages.length > 0) {
                errorMessages[0].remove();
            }
            const self = this;
            self.loading = true;
            axios.post('modules/administration/pdfsettings', self.pdf).then(function (response) {
                self.loading = false;
            }).catch(function () {
                self.loading = false;
                let err = pdfStorage.getItem('Errors');
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
                pdfStorage.removeItem('Errors');
            });
        },
        previewFile(event,field) {
            const self = this;
            const file = event.target.files[0];
            if(field=='upload_login_background'){
                this.login_background_previewImg = URL.createObjectURL(file);
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = event => {
                    self.pdf.upload_login_background = event.target.result;
                };
            }
            
            if(field=='upload_login_logo'){
                this.upload_login_logo_previewImg = URL.createObjectURL(file);
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = event => {
                    self.pdf.upload_login_logo = event.target.result;
                };  
            }
            
            if(field=='upload_logo'){
                this.upload_logo_previewImg = URL.createObjectURL(file);
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = event => {
                    self.pdf.upload_logo = event.target.result;
                };  
            }
            
            if(field=='upload_nabh_logo'){
                this.upload_nabh_logo_previewImg = URL.createObjectURL(file);
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = event => {
                    self.pdf.upload_nabh_logo = event.target.result;
                };  
            }
        },

        changeFile(e) {
            const self = this;
            this.avatar_preview = null;
            self.preview_image = true;
            let image = e.target.files[0];
            let file_type_arr = e.target.files[0].type.split("/");

            self.fileName = file_type_arr;
            self.showFileName = image.name;
            this.avatar_preview = URL.createObjectURL(e.target.files[0]);
            this.pdf.avatar_preview = URL.createObjectURL(e.target.files[0]);
            // console.log(self.pdf.avatar_path);
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                self.pdf.file_content = e.target.result;
                self.pdf.fileUpload = true;
            };
        },
    },

}