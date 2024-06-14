<template>
      <div class="container-fluid">
        <form @submit.prevent="saveUserDashlet">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row">
                    
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="user_type">{{lang.LBL_USER_TYPE}}</label>
                                <select class="form-select" id="user_type" v-model="user.user_type">
                                    <option value="">Select</option>
                                    <option v-for="(value, key) in dom_array.user_type" :value="key">{{value}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="user_type">{{lang.LBL_MODULE_DASHLETS}}</label>
                                <select class="form-select" id="module" v-model="user.module">
                                    <option value="">Select</option>
                                    <option v-for="(value, key) in dom_array.module_dashlet" :value="key">{{value}}</option>
                                </select>
                            </div>
                        </div>
                       
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">{{lang.LBL_DASHLET_TYPE}}</label>
                                <div class="form-check d-inline-block">
                                    <input type="checkbox" value="1" class="form-check-input" v-model="user.graph" @click="enableGraphType" id="gType">
                                    <label class="form-check-label">{{lang.LBL_DASHLET_GRAPH}}</label>
                                </div>
                                <div class="form-check d-inline-block">
                                     <input type="checkbox" value="1" class="form-check-input" v-model="user.table">
                                    <label class="form-check-label">{{lang.LBL_DASHLET_TABLE}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="user_type">{{lang.LBL_GRAPH_TYPE}}</label>
                                <select class="form-select" v-model="user.graph_type" :disabled="disabled">
                                    <option value="">Select</option>
                                    <option v-for="(value, key) in dom_array.graph_category" :value="key">{{value}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="user_type">{{lang.LBL_LEFT_WIDTH}}</label>
                                <input type="text" id="left_width" v-model="user.leftWidth" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="user_type">{{lang.LBL_RIGHT_WIDTH}}</label>
                                <input type="text" id="right_width" v-model="user.rightWidth" class="form-control"/>
                            </div>
                        </div>
                       

                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body text-end">
                    <button btntype="Submit" class="btn btn-success btn-sm btn btn-green shadow-sm rounded-md">
                        Save
                    </button>
                    <router-link to="/modules/userdashlets" class="btn btn-warning btn-sm router-link-active" btntype="button">
                    Cancel
                    </router-link>
                    
                    
                </div>
            </div>
         </form>
      </div>             
</template>

<script src="@/views/modules/UserDashlets/js/NewView.js"></script>