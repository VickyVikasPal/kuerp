<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>Create View</h3>
                    </div>
                    <form @submit.prevent="SaveForm" method="post">
                        <div class="card-body">
                        <div class="col-12">
                            <div class="row">
                                <template v-for="list in data">
                                    <template v-if="list.type == 'select_component'">
                                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12" :key="list">
                                            <div class="form-group item-select">
                                                <label>{{list.label}} <span v-if="list.required==true" class="error">*</span></label>
                                                <input type="hidden" name="" id="parent_id" v-model="res[list.parent_id]">
                                                <input type="hidden" name="" id="parent_type" v-model="res[list.parent_type]">
                                                <input  type="text" class="form-control" v-model="res[list.linkComponent+'_name']" :id="`${list.linkComponent}_name`" autocomplete="off" v-on:keyup="queryForKeywords($event, 'Category')" v-on:keydown="queryForKeywords($event, 'category')"/>

                                                <span class="group-select">
                                                    <span ref="genericSearch"
                                                        @click="openComponent(list.linkComponent+'s',list.moduleName)"><i
                                                            class="fa-solid fa-user-plus"></i></span>
                                                    <span @click="clearComponent(list.linkComponent)"><i
                                                            class="fa-solid fa-xmark"></i></span>
                                                </span>
                                                
                                                <ul class="dropdown_type" v-if="showDropdown">
                                                    <li v-for="item in dropdownList" :key="item.id" @click="updateItem(item.id,item.name,'category')">{{item.name}}</li>
                                                </ul>
                                            </div>
                                            <template v-if="list.required == true">
                                                <span v-if="selectComponentError == true"
                                                    v-bind:class="'error'">{{inputMessage}}</span>
                                                <span v-else></span>
                                            </template>
                                        </div>
                                    </template>
                                    <template v-if="list.type == 'text'">
                                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12" :key="list">
                                            <div class="form-group">
                                                <label> {{list.label}} <span v-if="list.required==true" class="error">*</span> </label>
                                                <input type="text" v-bind:id="list.name" v-model="res[list.name]" class="form-control"/>
                                            </div>
                                            <template v-if="list.required == true">
                                                <span v-if="inputError == true"
                                                    v-bind:class="'error'">{{inputMessage}}</span>
                                                <span v-else></span>
                                            </template>
                                        </div>
                                    </template>
                                    <template v-if="list.type == 'selectbox'">
                                        <div class="col-md-2 col-sm-4" :key="list">
                                            <div class="form-group">
                                                <label> {{list.label}} <span v-if="list.required==true" class="error">*</span></label>
                                                <select type="text" v-bind:id="list.name" v-model="res[list.name]" class="form-select form-control">
                                                    <option v-for="item in list.items" :key="item" :value="item.value">{{item.value}}</option>
                                                </select>
                                            </div>
                                            <template v-if="list.required == true">
                                                <span v-if="selectboxError == true"
                                                    v-bind:class="'error'">{{inputMessage}}</span>
                                                <span v-else></span>
                                            </template>
                                        </div>
                                    </template>
                                    <template v-if="list.type =='textarea'">
                                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12" :key="list">
                                            <div class="form-group">
                                                <label>{{ list.label }} <span v-if="list.required==true" class="error">*</span></label>
                                                <textarea class="text-area" v-bind:id="list.name" v-model="res[list.name]" rows="2" cols="10"></textarea>
                                            </div>
                                            <template v-if="list.required == true">
                                                <span v-if="textareaError == true"
                                                    v-bind:class="'error'">{{inputMessage}}</span>
                                                <span v-else></span>
                                            </template>
                                        </div>
                                    </template>
                                    <template v-if="list.type =='uploadfile'">
                                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>{{ list.label }} <span v-if="list.required==true" class="error">*</span></label>
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <div class="avatar-editor me-3">
                                                        <img :src="'/uploads/'+avatar_preview+'/'+res[list.name]"
                                                            alt="No Preview" class="avatar-img border-1"
                                                            style="width: 2.5rem;height: 2.5rem;border-radius: 50%;" />

                                                    </div>
                                                    <div class="btn btn-sm btn-file mb-2">
                                                        <i class="fa-solid fa-folder"></i>
                                                        <input ref="uploadFile" accept=".png,.jpg,.jpeg" type="file"
                                                            @change="changeFile($event)" v-bind:name="list.name"
                                                            v-bind:id="list.name" class="form-control">
                                                        <span>Browse …</span>
                                                    </div>
                                                </div>
                                                <div class="error" style="word-break: break-all;">{{showFileName}}</div>
                                            </div>
                                            <template v-if="list.required == true">
                                                <span v-if="inputError == true"
                                                    v-bind:class="'error'">{{inputMessage}}</span>
                                                <span v-else></span>
                                            </template>
                                        </div>
                                    </template>
                                    <template v-if="list.type =='checkbox'">
                                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label class="d-block">{{ list.label }}</label>
                                                <input type="checkbox" v-bind:id="list.name"
                                                    v-model="res[list.name]" :true-value="list.value"
                                                    :flase-value="'list.value'" />
                                            </div>
                                        </div>
                                    </template>
                                    <template v-if="list.type =='radio'">
                                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>{{ list.headlable }}</label>
                                                <div class="radio-items">
                                                    <template v-for="radioItem in list.label">
                                                        <span class="check-radio">
                                                            <label>{{ radioItem.childlabel }}</label>
                                                            <input type="radio" v-bind:id="radioItem.name"
                                                                v-model="res[radioItem.name]"
                                                                :value="radioItem.value" />
                                                        </span>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-if="list.type =='date'">
                                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>{{ list.label }} <span v-if="list.required==true" class="error">*</span></label>
                                                <Datepicker :id="list.name" v-model="res[list.name]"
                                                    :use-utc="false"
                                                    :calendar-button-icon="'fa-solid fa-calendar-days'"
                                                    :format="customFormatter"></Datepicker>
                                            </div>
                                            <template v-if="list.required == true">
                                                <span v-if="dateError == true"
                                                    v-bind:class="'error'">{{dateMessage}}</span>
                                                <span v-else></span>
                                            </template>
                                        </div>
                                    </template>
                                    <template v-if="list.type =='datetime'">
                                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>{{ list.label[0].label }} <span v-if="list.required==true" class="error">*</span></label>
                                                <Datepicker :id="list.name" v-model="res[list.name]"
                                                    :input-class="'form-control'"
                                                    :calendar-button="true" :use-utc="false"
                                                    :calendar-button-icon="'fa-solid fa-calendar-days'"
                                                    :format="customFormatter"></Datepicker>
                                            </div>
                                            <template v-if="list.required == true">
                                                <span v-if="dateError == true"
                                                    v-bind:class="'error'">{{dateMessage}}</span>
                                                <span v-else></span>
                                            </template>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>{{ list.label[1].label }} <span v-if="list.required==true" class="error">*</span></label>
                                                <Timepicker :datetime="'datetime'"></Timepicker>
                                            </div>
                                            <template v-if="list.required == true">
                                                <span v-if="dateError == true"
                                                    v-bind:class="'error'">{{dateMessage}}</span>
                                                <span v-else></span>
                                            </template>
                                        </div>
                                    </template>
                                    <template v-if="list.type =='password'">
                                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>{{ list.label }} <span v-if="list.required==true" class="error">*</span></label>
                                                <input type="password" class="form-control" v-bind:id="list.name" v-model="res[list.name]">
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
                        <div class="col-12">
                            <template v-if="errorLog">
                                <label class="text-danger">{{errorMessage}}</label>
                            </template>
                        </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" value="Submit" class="btn btn-success btn-sm">Submit</button>
                            <router-link :to="'/modules/'+modules" class="btn btn-warning btn-sm">Cancel</router-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Datepicker from 'vuejs3-datepicker';
import Timepicker from "@/components/layout/shared/common/TimeView.vue";
export default {
    name:'genericEdit',
    components:{
        Datepicker,
        Timepicker,
    },
    data(){
        return {
            data:[],
            res:{},
            modules:null,
            errorLog:false,
            errorMessage:null,
            record:'',
            dropdownList:[], 
            showDropdown:false,
            selectComponentError:false,
            inputError:false,
            selectboxError:false,
            textareaError:false,
            dateError:false,

        }
    },
    methods:{
        loadGenericView(metaList,modules){
        
           this.data = metaList;
           this.modules = modules.path;
          
        },
        SaveForm(){
            const self = this;
            self.errorLog = false;
           
            axios.post('/modules/'+self.modules, self.res).then(res=>{
                if(res.data.message){
                    //console.log(res.data.success);
                    self.$router.push({path:'/modules/'+self.modules});
                }else{
                    self.errorLog = true;
                    self.errorMessage = response.data.message;
                }
            }).catch((error) => {
                if (error) {
                    self.errorLog = true;
                    self.errorMessage = error.response.data.message;
                }
            })
            
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
                axios.post(`modules/searchItem`, { 'data': searchData, 'relatedModule': relatedModule }).then(function (response) {
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
    }
}
</script>

