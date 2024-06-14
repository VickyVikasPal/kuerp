<template>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <template v-if="loading">
                        <loader></loader>
                    </template>
                    <div class="card mb-2">
                        <div class="card-header">
                            <h3>Edit View</h3>
                        </div>
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
                                                        v-model="dataRecord[input.name]"/>
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
                                                    <label :for="input.name">{{ input.label }} <span
                                                            v-if="input.required==true" class="error">*</span></label>
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <div class="avatar-editor me-3">
                                                            <img :src="dataRecord[input.name]" alt="No Preview"
                                                                class="avatar-img border-1"
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
                                                        v-model="dataRecord[input.name]" :true-value="input.value"
                                                        :flase-value="'input.value'"/>
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
                                                                    v-model="dataRecord[radioItem.name]"
                                                                    :value="radioItem.value"/>
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
                                                        v-model="dataRecord[input.name]" rows="2" cols="10"></textarea>
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
                                                        v-model="dataRecord[input.name]" selected="selected">
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

                                                  <!--  <Datepicker :id="input.name" v-model="dataRecord[input.name]" v-else
                                                        :input-class="'form-control'" :calendar-button="true"
                                                        :use-utc="false"
                                                        :calendar-button-icon="'fa-solid fa-calendar-days'"
                                                        :format="customFormatter"></Datepicker>!-->
                                                </div>
                                                <template v-if="input.required == true">
                                                    <span v-if="dateError == true"
                                                        v-bind:class="'error'">{{dateMessage}}-{{dateError}}</span>
                                                    <span v-else></span>
                                                </template>
                                            </div>
                                        </template>

                                        <template v-if="input.type=='select_component'">

                                            <div :class="'col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12'">
                                                <div :class="'form-group item-select'">
                                                    <label :for="input.name">{{ input.label }} <span
                                                            v-if="input.required==true" class="error">*</span></label>
                                                   
                                                        <input type="hidden" :id="input.parent_id"
                                                            v-model="dataRecord[input.parent_id]">
                                                        <input type="hidden" :id="input.parent_type"
                                                            v-model="dataRecord[input.parent_type]">

                                                    <input type="text" class="form-control" v-bind:id="input.name"
                                                        v-model="dataRecord[input.name]"
                                                        v-on:keyup="queryForKeywords($event, input.linkComponent)"
                                                        v-on:keydown="queryForKeywords($event, input.linkComponent)"
                                                        autocomplete="off"/>

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
                                                        v-model="dataRecord[input.name]"/>
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
                                        <CancelButton :to="`/modules/${modules}`" :label="'Cancel'" :btntype="'button'"
                                            class="btn btn-warning btn-sm" v-if="record==null" />
                                        <CancelButton :to="`/modules/${modules}/${record}/detail`" :label="'Cancel'"
                                            :btntype="'button'" class="btn btn-warning btn-sm" v-else />
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
    //import Datepicker from 'vuejs-datepicker';
    import loader from "@/views/shared/loading/Loading.vue";
    import DateFormat from "@/plugins/date_format.js";

    export default {
        name: 'genericEdit',
        components: {

            CancelButton,
            SaveButton,
           // Datepicker,
            loader,
        },
        props: {
            urls: {
                type: String
            },
        },
        data() {
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
                dateFormat: '',
            }
        },

        mounted() {
            this.pageUrl = this.$props.urls;
        },
        methods: {
            saveProduct() {
                const self = this;
                self.loading = true;

                let editFormData = '';

                editFormData = self.dataRecord;

                let formvalue = '';

                Object.keys(self.data).forEach((key) => {

                    if (self.data[key].required == true) {

                        if (self.data[key].type == 'text') {
                            formvalue = document.getElementById(self.data[key].name).value;
                            if (formvalue == '') {
                                avatar
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

                    axios.put(this.pageUrl + '/' + self.$route.params.id, { editFormData, 'fileContent': self.file_content, 'fileExt': fileExt, 'fileUpload': self.fileUpload, headers: { 'Content-Type': 'multipart/form-data' } }).then(function () {
                        self.loading = false;
                        
                        if (self.route.detail == true) {
                            self.$router.push(`/modules/${self.route.path}/${response.data.product.id}/detail`);
                        } else {
                            self.$router.push(`/modules/${self.route.path}`);
                        }
                    }).catch(function () {
                        self.loading = false;
                    });
                } else {
                    console.log('Error');
                }
            },

            loadGenericView(metaList, routePath) {
                this.record = this.$route.params.id;
                if (this.record != null) {
                    this.data = metaList;
                    this.route = routePath;// Object assign to route
                    this.modules = routePath.path; // path assign to module
                    this.getRecord(this.record);
                } else {
                    this.data = metaList;
                    this.route = routePath; // Object assign to route
                    this.modules = routePath.path; // path assign to module
                }
            },

            getRecord(record) {
                const self = this;

                axios.get(`${self.pageUrl}/${record}`).then(function (response) {

                    self.dataRecord = response.data;

                    /*   let db_date_entred = (response.data.db_date_entred).split('-');
                      self.avatar_preview = `${db_date_entred[0]}/${db_date_entred[1]}`;
                      console.log(db_date_entred); */

                }).catch(function () {
                    console.log('Data Not Found');
                });
            },

            printDate() {
                const self = this;
                let user_prefrence = user_prefrence = JSON.parse(localStorage.getItem('user_prefrence'));
                let userFormat = user_prefrence.dateformat;
                let dateObj = new DateFormat(userFormat)
                let format = dateObj.getFormat();
                /* console.log(format);
                console.log(userFormat); */
                self.dateFormat = format;
            },
            openComponent(routeName, moduleName, queryData = null) {
                this.windowRef = window.open(`/popup?module=${routeName}&body=modal&callback=parentMethod&moduleName=${moduleName}`, "", "width=600,height=400,left=200,top=200");
                this.parentCompnent = routeName;
                this.windowRef.addEventListener('beforeunload', this.parentMethod);
            },
            customFormatter(date) {
                return moment(date).format('DD/MM/YYYY');
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
        },

    }



</script>