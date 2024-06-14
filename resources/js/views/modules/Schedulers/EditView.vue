<template>
      <div class="container-fluid">
         <form @submit.prevent="saveScheduler" enctype="multipart/form-data">
            <div class="card mb-2">
               <div class="card-header">
                  <h3>{{lang.LBL_BASIC_SETUP}}</h3>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                              <label>{{lang.LBL_JOB_NAME}} <span class="required">*</span></label>
                              <input class="form-control" type="text" id="name" v-model="scheduler.name">
                        </div>
                     </div>
                     <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                              <label>{{lang.LBL_JOB_STATUS}} <span class="required">*</span></label>
                              <select class="form-select" id="status" v-model="scheduler.status">
                                 <option v-for="(value, key) in dom_array.status" :value="value">{{ value }}</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                           <label>{{lang.LBL_JOB}} <span class="required">*</span></label>
                           <select class="form-select" id="job" v-model="scheduler.job">
                              <option value="">Select</option>
                              <option v-for="(value, key) in job_array" :value="value">{{ value }}</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                           <label>{{lang.LBL_JOB_OR}}</label>
                           <input class="form-control" type="text" id="job_url" v-model="scheduler.job_url">
                        </div>
                     </div>
                  </div>


                  <div id="simple">
                    <!--  <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                           <div class="form-group d-flex justify-content-between">
                              <label>{{lang.LBL_INTERVAL}} <span class="required">*</span></label>
                           </div>
                        </div>
                     </div> -->
                     <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                           <div class="form-group">
                                 <label>{{lang.LBL_EVERY}} </label>
                                 <div class="w-100 add-on-multi-text d-flex justify-content-between">
                                    <select class="form-select" id="basic_interval" v-model="scheduler.basic_interval">
                                       <option v-for="number in numbers" :value="number" :key="number">{{ number }}</option>
                                    </select>
                                    <select class="form-select" id="basic_period" v-model="scheduler.basic_period">
                                       <option value="min">Minutes</option>
                                       <option value="hour">Hours</option>
                                    </select>
                                 </div>
                           </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                              <div class="form-check">
                                 <input type="checkbox" class="form-check-input" id="all" v-model="scheduler.all" value="all">
                                 <label class="form-check-label" for="all">{{lang.LBL_EVERY_DAY}}</label>
                              </div>
                              <div class="form-check">
                                 <input type="checkbox" class="form-check-input" id="mon" v-model="scheduler.mon" value="mon">
                                 <label class="form-check-label" for="mon">{{lang.LBL_MONDAY}}</label>
                              </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                              <div class="form-check">
                                 <input type="checkbox" class="form-check-input" id="tue" v-model="scheduler.tue" value="tue">
                                 <label class="form-check-label" for="tue">{{lang.LBL_TUESDAY}}</label>
                              </div>
                              <div class="form-check">
                                 <input type="checkbox" class="form-check-input" id="wed" v-model="scheduler.wed" value="wed">
                                 <label class="form-check-label" for="wed">{{lang.LBL_WEDNESDAY}}</label>
                              </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                              <div class="form-check">
                                 <input type="checkbox" class="form-check-input" id="thu" v-model="scheduler.thu" value="thu">
                                 <label class="form-check-label" for="thu">{{lang.LBL_THURSDAY}}</label>
                              </div>
                              <div class="form-check">
                                 <input type="checkbox" class="form-check-input" id="fri" v-model="scheduler.fri" value="fri">
                                 <label class="form-check-label" for="fri">{{lang.LBL_FRIDAY}}</label>
                              </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                              <div class="form-check">
                                 <input type="checkbox" class="form-check-input" id="sat" v-model="scheduler.sat" value="sat">
                                 <label class="form-check-label" for="sat">{{lang.LBL_SATURDAY}}</label>
                              </div>
                              <div class="form-check">
                                 <input type="checkbox" class="form-check-input" id="sun" v-model="scheduler.sun" value="sun">
                                 <label class="form-check-label" for="sun">Sunday</label>
                              </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card mb-2">
               <div class="card-body text-end">
                  <button btntype="Submit" class="btn btn-success btn-sm">
                     Save
                 </button>
                 <router-link class="btn btn-warning btn-sm" to="/modules/schedulers">Cancel</router-link>
               </div>
            </div>

         </form>
      </div>
</template>

<script src="@/views/modules/Schedulers/js/EditView.js"></script>