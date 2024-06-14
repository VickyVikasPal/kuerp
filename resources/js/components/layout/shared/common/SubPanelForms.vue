<template>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <template v-if="loading">
                        <loader></loader>
                    </template>
                    <div class="card mb-2">
                        <!--<div class="card-header">
                            <h3>Edit View</h3>
                        </div>!-->
                        <form @submit.prevent="saveProduct" enctype="multipart/form-data">
                            <div class="card-body">

                                <div :class="'row'">

                                    <template v-for="input in data">

                                        <template v-if="input.type=='text'">
                                            <div :class="'col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12'">
                                                <div :class="'form-group'">
                                                    <label :for="input.name">{{ input.label }} <span
                                                            v-if="input.required==true" class="error">*</span></label>
                                                    <input type="text" class="form-control" v-bind:id="input.name"
                                                        v-model="res[input.name]" v-if="dataRecord ==''" />
                                                    <input type="text" class="form-control" v-bind:id="input.name"
                                                        v-model="dataRecord[input.name]" v-else />
                                                </div>
                                                <template v-if="input.required == true">
                                                    <span v-if="inputError == true"
                                                        v-bind:class="'error'">{{inputMessage}}</span>
                                                    <span v-else></span>
                                                </template>
                                            </div>
                                        </template>

                                        <template v-if="input.type=='uploadfile'">
                                            <div :class="'col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12'">
                                                <div :class="'form-group'">
                                                    <label :for="input.name">{{ input.label }} <span v-if="input.required==true" class="error">*</span></label>
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <div class="avatar-editor me-3">
                                                            <img :src="'/uploads/'+avatar_preview+'/'+dataRecord[input.name]"
                                                                alt="No Preview" class="avatar-img border-1"
                                                                style="width: 2.5rem;height: 2.5rem;border-radius: 50%;" />

                                                        </div>
                                                        <div class="btn btn-sm btn-file mb-2">
                                                            <i class="fa-solid fa-folder"></i>
                                                            <input ref="uploadFile" accept=".png,.jpg,.jpeg" type="file"
                                                                @change="changeFile($event)" v-bind:name="input.name"
                                                                v-bind:id="input.name" class="form-control">
                                                            <span>Browse …</span>
                                                        </div>

                                                    </div>
                                                    <div class="error" style="word-break: break-all;">{{showFileName}}
                                                    </div>

                                                </div>
                                                <template v-if="input.required == true">
                                                    <span v-if="inputError == true"
                                                        v-bind:class="'error'">{{inputMessage}}</span>
                                                    <span v-else></span>
                                                </template>

                                            </div>
                                        </template>

                                        <template v-if="input.type=='checkbox'">
                                            <div :class="'col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12'">
                                                <div :class="'form-group'">
                                                    <label :for="input.name" class="d-block">{{ input.label }}</label>
                                                    <input type="checkbox" v-bind:id="input.name"
                                                        v-model="res[input.name]" :true-value="input.value"
                                                        :flase-value="'input.value'" v-if="dataRecord ==''" />
                                                    <input type="checkbox" v-bind:id="input.name"
                                                        v-model="dataRecord[input.name]" :true-value="input.value"
                                                        :flase-value="'input.value'" v-else />
                                                </div>
                                            </div>
                                        </template>

                                        <template v-if="input.type=='radio'">
                                            <div :class="'col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12'">
                                                <div :class="'form-group'">
                                                    <label :for="input.headlable">{{ input.headlable }}</label>
                                                    <div class="radio-items">
                                                        <template v-for="radioItem in input.label">
                                                            <span class="check-radio">
                                                                <label :for="radioItem.childlabel">{{
                                                                    radioItem.childlabel }}</label>
                                                                <input type="radio" v-bind:id="radioItem.name"
                                                                    v-model="res[radioItem.name]"
                                                                    :value="radioItem.value" v-if="dataRecord ==''" />
                                                                <input type="radio" v-bind:id="radioItem.name"
                                                                    v-model="dataRecord[radioItem.name]"
                                                                    :value="radioItem.value" v-else />
                                                            </span>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>

                                        <template v-if="input.type=='textarea'">
                                            <div :class="'col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12'">
                                                <div :class="'form-group'">
                                                    <label :for="input.name">{{ input.label }} <span
                                                            v-if="input.required==true" class="error">*</span></label>
                                                    <textarea class="text-area" v-bind:id="input.name"
                                                        v-model="res[input.name]" rows="2" cols="10"
                                                        v-if="dataRecord ==''"></textarea>
                                                    <textarea class="text-area" v-bind:id="input.name"
                                                        v-model="dataRecord[input.name]" rows="2" cols="10"
                                                        v-else></textarea>
                                                </div>
                                                <template v-if="input.required == true">
                                                    <span v-if="textareaError == true"
                                                        v-bind:class="'error'">{{textareaMessage}}</span>
                                                    <span v-else></span>
                                                </template>
                                            </div>
                                        </template>

                                        <template v-if="input.type=='selectbox'">
                                            <div :class="'col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12'">
                                                <div :class="'form-group'">
                                                    <label :for="input.name">{{ input.label }} <span
                                                            v-if="input.required==true" class="error">*</span></label>
                                                    <select class="form-select" v-bind:id="input.name"
                                                        v-model="res[input.name]" v-if="dataRecord ==''">
                                                        <option v-for="item in input.items" :value="item.value"
                                                            :key="item.id">
                                                            {{ item.value }}
                                                        </option>
                                                    </select>
                                                    <select class="form-select" v-bind:id="input.name"
                                                        v-model="dataRecord[input.name]" selected="selected" v-else>
                                                        <option v-for="item in input.items" :value="item.value"
                                                            :key="item.id">
                                                            {{ item.value }}
                                                        </option>
                                                    </select>
                                                </div>
                                                <template v-if="input.required == true">
                                                    <span v-if="selectError == true"
                                                        v-bind:class="'error'">{{selectMessage}}</span>
                                                    <span v-else></span>
                                                </template>
                                            </div>
                                        </template>

                                        <template v-if="input.type=='date'">
                                            <div :class="'col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12'">
                                                <div :class="'form-group'">
                                                    <label :for="input.name">{{ input.label }} <span
                                                            v-if="input.required==true" class="error">*</span></label>

                                                    <Datepicker :id="input.name" v-model="res[input.name]"
                                                        v-if="dataRecord ==''" :input-class="'form-control'"
                                                        :calendar-button="true" :use-utc="false"
                                                        :calendar-button-icon="'fa-solid fa-calendar-days'"
                                                        :format="customFormatter"></Datepicker>

                                                    <Datepicker :id="input.name" v-model="dataRecord[input.name]" v-else
                                                        :input-class="'form-control'" :calendar-button="true"
                                                        :calendar-button-icon="'fa-solid fa-calendar-days'"
                                                        :format="customFormatter"></Datepicker>
                                                </div>
                                                <template v-if="input.required == true">
                                                    <span v-if="dateError == true"
                                                        v-bind:class="'error'">{{dateMessage}}-{{dateError}}</span>
                                                    <span v-else></span>
                                                </template>
                                            </div>
                                        </template>

                                        <template v-if="input.type=='datetime'">
                                            <div :class="'col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12'">
                                                <div :class="'form-group'">
                                                    <label :for="input.name">{{ input.label[0].label }} <span
                                                            v-if="input.required==true" class="error">*</span></label>

                                                    <Datepicker :id="input.name" v-model="res[input.name]"
                                                        v-if="dataRecord ==''" :input-class="'form-control'"
                                                        :calendar-button="true" :use-utc="false"
                                                        :calendar-button-icon="'fa-solid fa-calendar-days'"
                                                        :format="customFormatter"></Datepicker>

                                                    <Datepicker :id="input.name" v-model="dataRecord[input.name]" v-else
                                                        :input-class="'form-control'" :calendar-button="true"
                                                        :calendar-button-icon="'fa-solid fa-calendar-days'"
                                                        :format="customFormatter"></Datepicker>
                                                </div>
                                                <template v-if="input.required == true">
                                                    <span v-if="dateError == true"
                                                        v-bind:class="'error'">{{dateMessage}}-{{dateError}}</span>
                                                    <span v-else></span>
                                                </template>
                                            </div>
                                            <div :class="'col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12'">
                                                <div :class="'form-group'">
                                                    <label :for="input.name">{{ input.label[1].label }} <span
                                                            v-if="input.required==true" class="error">*</span></label>

                                                   <Timepicker :datetime="'datetime'"></Timepicker>
                                                    
                                                </div>
                                                <template v-if="input.required == true">
                                                    <span v-if="dateError == true"
                                                        v-bind:class="'error'">{{dateMessage}}-{{dateError}}</span>
                                                    <span v-else></span>
                                                </template>
                                            </div>
                                        </template>

                                        <template v-if="input.type=='selectcomponent'">

                                            <div :class="'col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12'">
                                                <div :class="'form-group item-select'">
                                                    <label :for="input.name">{{ input.label }} <span
                                                            v-if="input.required==true" class="error">*</span></label>

                                                    <template v-if="dataRecord ==''">
                                                        <input type="hidden" :id="input.parent_id"
                                                            v-model="res[input.parent_id]">
                                                        <input type="hidden" :id="input.parent_type"
                                                            v-model="res[input.parent_type]">
                                                    </template>
                                                    <template v-else>
                                                        <input type="hidden" :id="input.parent_id"
                                                            v-model="dataRecord[input.parent_id]">
                                                        <input type="hidden" :id="input.parent_type"
                                                            v-model="dataRecord[input.parent_type]">
                                                    </template>

                                                    <input type="text" class="form-control" v-bind:id="input.name"
                                                        v-model="res[input.name]" v-if="dataRecord ==''"
                                                        v-on:keyup="queryForKeywords($event, input.linkComponent)"
                                                        v-on:keydown="queryForKeywords($event, input.linkComponent)"
                                                        autocomplete="off" />

                                                    <input type="text" class="form-control" v-bind:id="input.name"
                                                        v-model="dataRecord[input.name]"
                                                        v-on:keyup="queryForKeywords($event, input.linkComponent)"
                                                        v-on:keydown="queryForKeywords($event, input.linkComponent)"
                                                        autocomplete="off" v-else />

                                                    <span class="group-select">
                                                        <span ref="genericSearch"
                                                            @click="openComponent(input.linkComponent+'s',input.moduleName)"><i
                                                                class="fa-solid fa-user-plus"></i></span>
                                                        <span @click="clearComponent(input.linkComponent)"><i
                                                                class="fa-solid fa-xmark"></i></span>
                                                    </span>

                                                    <ul v-if="showDropdown" class="dropdown_type">
                                                        <li v-for="item in dropdownList" :key="item.id"
                                                            @click="updateItem(item.id,item.name,input.linkComponent)">
                                                            {{item.name}}</li>
                                                    </ul>

                                                </div>


                                                <template v-if="input.required == true">
                                                    <span v-if="inputError == true"
                                                        v-bind:class="'error'">{{inputMessage}}</span>
                                                    <span v-else></span>
                                                </template>
                                            </div>
                                        </template>

                                        <template v-if="input.type=='password'">
                                            <div :class="'col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12'">
                                                <div :class="'form-group'">
                                                    <label :for="input.name">{{ input.label }} <span
                                                            v-if="input.required==true" class="error">*</span></label>
                                                    <input type="password" class="form-control" v-bind:id="input.name"
                                                        v-model="res[input.name]" v-if="dataRecord ==''" />
                                                    <input type="password" class="form-control" v-bind:id="input.name"
                                                        v-model="dataRecord[input.name]" v-else />
                                                </div>
                                                <template v-if="input.required == true">
                                                    <span v-if="inputError == true"
                                                        v-bind:class="'error'">{{inputMessage}}</span>
                                                    <span v-else></span>
                                                </template>
                                            </div>
                                        </template>

                                    </template>

                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <SaveButton :btntype="'Submit'" :label="'Save'"
                                            class="btn btn-success btn-sm" />
                                        <button class="btn btn-warning btn-sm" @click="loadList()">Cancel</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
</template>
<script>
    import { reactive, ref } from "vue";
    import CancelButton from "@/views/shared/buttons/CancelButton.vue";
    import SaveButton from "@/views/shared/buttons/SaveButton.vue";
   // import Datepicker from 'vuejs-datepicker';
    import loader from "@/views/shared/loading/Loading.vue";
    import Timepicker from "@/components/layout/shared/common/TimeView.vue";

export default {
    name:"subpanelForm",
    components:{
            CancelButton,
            SaveButton,
            Datepicker,
            loader,
            Timepicker,
    },
    data(){
        return {
                data: [],
                pageUrl: null,
                res: {},
                route: null,
                record: null,
                dataRecord: [],
                inputError: false,
                inputMessage: '',
                selectError: false,
                selectMessage: '',
                textareaError: false,
                textareaMessage: '',
                dateError: false,
                dateMessage: '',
                modules: null,
                windowRef: null,
                parentCompnent: null,
                dropdownList: [],
                showDropdown: false,
                avatar_preview: null,
                gravatar: null,
                file_content: null,
                fileUpload: false,
                fileName: [],
                loading: false,
                showFileName: null,
                moduleName:'',
        }
    },
    methods: {
        loadNewFormData(mname, frmType){
            const self = this;
            self.moduleName = mname;
            self.path = mname.toLowerCase();
            
            if(frmType =='AddNew'){
           ////resources/js/views/modules/StateLists/metaview/metajs/SubPanelList.js
                import(`@/views/modules/${mname}/metaview/metajs/SubPanelNew.js`).then(function(res){
                    self.showForm(res.default, mname);
                });
                
            }
        },
        showForm(formElement, mname){
            const self = this;
            self.data = formElement.metaList;
            self.pageUrl = formElement.urls;
           // console.log(self.pageUrl);
           
        },
        saveProduct() {
                const self = this;
                self.loading = true;

                let editFormData = '';
                if (self.record == null) {
                    editFormData = self.res;
                    let formvalue = '';

                    Object.keys(self.data).forEach((key) => {

                        if (self.data[key].required == true) {

                            if (self.data[key].type == 'text') {
                                formvalue = document.getElementById(self.data[key].name).value;
                                if (formvalue == '') {
                                    self.inputError = true;
                                    self.inputMessage = "This filed is required";
                                } else {
                                    self.inputError = false;
                                    self.inputMessage = "";
                                }
                            }

                            if (self.data[key].type == 'selectbox') {

                                formvalue = document.getElementById(self.data[key].name).value;
                                if (formvalue == '') {
                                    self.selectError = true;
                                    self.selectMessage = "This filed is required";
                                } else {
                                    self.selectError = false;
                                    self.selectMessage = "";
                                }
                            }

                            if (self.data[key].type == 'textarea') {
                                formvalue = document.getElementById(self.data[key].name).value;
                                if (formvalue == '') {
                                    self.textareaError = true;
                                    self.textareaMessage = "This filed is required";
                                } else {
                                    self.textareaError = false;
                                    self.textareaMessage = "";
                                }

                            }

                            if (self.data[key].type == 'date') {
                                formvalue = document.getElementById(self.data[key].name).value;
                                if (formvalue == '') {
                                    self.dateError = true;
                                    self.dateMessage = "This filed is required";
                                } else {
                                    self.dateError = false;
                                    self.dateMessage = "";
                                }
                            }
                        }
                    });


                    if (self.inputError == false && self.selectError == false && self.textareaError == false && self.dateError == false) {

                        let fileExt = '';
                        if (self.fileName != '') {
                            fileExt = self.fileName[1];
                        }

                        axios.post(self.pageUrl, { editFormData, 'fileContent': self.file_content, 'fileExt': fileExt, 'fileUpload': self.fileUpload, headers: { 'Content-Type': 'multipart/form-data' } }).then(function (response) {
                            self.loading = false;
                            self.$notify({
                                title: self.$i18n.t('Success').toString(),
                                text: self.$i18n.t('Data saved correctly').toString(),
                                type: 'success'
                            });
                            /* if (self.route.detail == true) {
                                self.$router.push(`/modules/${self.route.path}/${response.data.product.id}/detail`);
                            } else {
                                self.$router.push(`/modules/${self.route.path}`);
                            } */
                            self.$emit('force-render', self.moduleName);

                        }).catch(function () {
                            self.loading = false;
                        });
                    } else {
                        console.log('Error');
                        self.loading = false;
                    }
                }

            },

            openComponent(routeName, moduleName,queryData = null) {

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

            queryForKeywords(e, modulesLink) {
                const self = this;
                let searchData = e.target.value;
                let relatedModule = modulesLink + 's';
                self.showDropdown = false;

                if (searchData.length > 1) {
                    axios.post(`api/modules/searchItem`, { 'data': searchData, 'relatedModule': relatedModule }).then(function (response) {
                        self.dropdownList = response.data;
                        self.showDropdown = true;
                    });
                } else {
                    self.showDropdown = false;
                    self.dropdownList = [];

                    if (searchData.length == 0) {
                        self.selectElement(modulesLink, '', '', '');
                    }

                }
            },

            updateItem(id, name, type) {
                this.showDropdown = false;
                const module_name = type;
                this.selectElement(module_name, name, id, type);
            },
            clearComponent(modulesLink) {
                const self = this;
                self.dropdownList = [];
                if (self.dropdownList.length == 0) {
                    self.selectElement(modulesLink, '', '', '');
                }
            },
            selectElement(moduleName, name = null, id = null, module = null) {
                const module_name = moduleName;
                const p_name = module_name + '_name';
                const p_name_el = document.getElementById(p_name);
                p_name_el.value = name;
                p_name_el.dispatchEvent(new Event('input'));

                const p_id = 'parent_id';
                const p_id_el = document.getElementById(p_id);
                p_id_el.value = id;
                p_id_el.dispatchEvent(new Event('input'));

                const p_type = 'parent_type';
                const p_type_el = document.getElementById(p_type);
                p_type_el.value = module;
                p_type_el.dispatchEvent(new Event('input'));
            },

            changeFile(e) {
                let image = e.target.files[0];
                let file_type_arr = e.target.files[0].type.split("/");
                this.fileName = file_type_arr;
                this.showFileName = image.name;
                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    this.file_content = e.target.result;
                    this.fileUpload = true;
                };
            },
            loadList(){
                const self = this;
               self.$emit('force-render', self.moduleName); 
            }
    },
}
</script>
