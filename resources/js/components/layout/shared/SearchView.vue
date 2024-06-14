<template >
    
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header"><h3>Search</h3></div>
                <div class="card-body">
                <form>
                    <div class="row">

                        <template v-for="input in data">

                            <!--Basic search-->
                            <template v-if="input.basic_search == true">
                                <template v-for="field in input.basic_fields">

                                        <template v-if="field.type=='text'">
                                            <div class="col-xl-2 col-lg-3 colmd-4 col-sm-6 col-12" v-bind:key="field">
                                                <div class="form-group">
                                                    <label :for="field.name">{{ field.label }}</label>
                                                    <input type="text" class="form-control" v-bind:id="field.name" v-model.lazy="res[field.name]">
                                                </div>
                                            </div>
                                        </template>

                                        <template v-if="field.type=='selectbox'">
                                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12" v-bind:key="field">
                                                <div :class="'form-group'">
                                                    <label :for="field.name">{{ field.label }}</label>
                                                    <select class="form-select" v-bind:id="field.name" v-model.lazy="res[field.name]">
                                                        <option v-for="item in field.items" :value="item" :key="item.id">
                                                            {{ item.value }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </template>


                                </template>
                            </template>

                            <!--Advance search-->
                            <template v-else>
                               <!-- <template v-for="field in input.basic_fields">
                                    
                                </template>!-->
                            </template>

                        </template>
                       
                    

                    </div>
                </form>
                </div>
                <div class="card-footer text-end">
                    <button  class="btn btn-success btn-sm" type="button" @click="genericSearch('Search')">
                        Search
                    </button>
                    <button class="btn btn-warning btn-sm" type="button" @click="genericSearch('Clear')">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
   
</template>
<script>

export default {
    name:'generic-search',
     components:{
       
    },
    data(){
        return {
            data:[],
            res:{},

        }
    },
    methods:{
        loadGenericSearch(searchItem){
            
            this.data = searchItem;
        },

         customFormatter(date) {
            return moment(date).format('DD/MM/yyyy hh:mm:ss a');
        },
        genericSearch(type){
            const self = this;
            if(type=='Search'){
                self.$emit('searchEvent', self.res)
            }
            if(type=='Clear'){
                self.res={};
                self.$emit('searchEvent', self.res)
            }
        }
    }
}
</script>
