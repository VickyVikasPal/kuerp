<template>
    <main>
        <breadcrumbs></breadcrumbs>
        
        <div class="container-fluid">
            <div class="card mb-2">
                <div class="card-header">
                    <h3>{{lang.LBL_SELECT_BRANCH}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_SELECT_BRANCH}}</label>
                                <select id="branch_id" class="form-select" name="branch_id" v-model="sequences.branch_id" @change="loadSequence()">
                                    <option value="">Select</option>
                                    <option v-for="(branchs, index) in branch_list" ::key="index" :value="branchs.id">{{branchs.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group mt-4">
                               <button type="search" class="btn btn-success btn-sm">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header">
                    <h3>{{lang.LBL_ADD_NEW}}</h3>
                </div>
                <form ref="sequenceForm" @submit.prevent="saveSequence">
                <input type="hidden" v-model="sequences.id"/>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_MODULE_NAME}}</label>
                                    <input type="text" class="form-control" v-model="sequences.name">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_FIELD}}</label>
                                    <input type="text" class="form-control" v-model="sequences.field_name">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_IDENTIFIERS}}</label>
                                    <input type="text" class="form-control" v-model="sequences.sequence_type">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_PREFIX}}</label>
                                    <input type="text" class="form-control" v-model="sequences.prefix">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_SEQUENCE}}</label>
                                    <input type="text" class="form-control" v-model="sequences.seq_no">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_DATE_FIELD}}</label>
                                    <input type="text" class="form-control" v-model="sequences.date_field">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_PERIOD}}</label>
                                    <select class="form-select" v-model="sequences.period">
                                        <option value="">None</option>
                                        <option value="Y">Year</option>
                                        <option value="YM">YM</option>
                                        <option value="YMD">YMD</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                        <button type="button" @click="clear()" class="btn btn-warning btn-sm">Cancel</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered table-striped m-0 item_table">
                            <thead>
                                <tr>
                                    <th>{{lang.LBL_MODULE_NAME}}</th>
                                    <th>{{lang.LBL_FIELD}}</th>
                                    <th>{{lang.LBL_IDENTIFIERS}}</th>
                                    <th>{{lang.LBL_PREFIX}}</th>
                                    <th>{{lang.LBL_SEQUENCE}}</th>
                                    <th>{{lang.LBL_DATE_FIELD}}</th>
                                    <th>{{lang.LBL_ACTION}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(seq, index) in listData" :key="index">
                                    <td>{{seq.name}}</td>
                                    <td>{{seq.field_name}}</td>
                                    <td>{{seq.sequence_type}}</td>
                                    <td>{{seq.prefix}}</td>
                                    <td>{{seq.seq_no}}</td>
                                    <td>{{seq.date_field}}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="mx-1" @click="editSequence(seq.id)"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="javascript:void(0)" class="mx-1" @click="removeSequence(seq.id)"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="d-flex justify-content-end align-items-center">
                        <button disabled="disabled" type="button" class="pagination-link btn btn-secondary btn-sm opacity-50" @click="changePage(pagination.currentPage - 1)" :class="pagination.currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : ''" :disabled="pagination.currentPage <= 1">
                             <i class="fa-solid fa-angle-left"></i>
                        </button>
                        
                        <span class="mx-2">
                            <span class="font-medium">{{ (pagination.perPage * pagination.currentPage) - pagination.perPage + 1 }}</span>
                             to 
                             <span class="font-medium">{{ pagination.perPage * pagination.currentPage <= pagination.total ? pagination.perPage * pagination.currentPage : pagination.total }}</span>
                             of
                             <span class="font-medium">{{ pagination.total }}</span>
                        </span> 
                        <button disabled="disabled" type="button" class="ml-3 pagination-link btn btn-secondary btn-sm opacity-50" @click="changePage(pagination.currentPage + 1)" :class="pagination.currentPage >= pagination.totalPages ? 'opacity-50 cursor-not-allowed' : ''" :disabled="pagination.currentPage >= pagination.totalPages">
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

         <!--alert modal -->
        <!-- <alert ref="notifyMsg"></alert> -->

    </main>
</template>
<script src="@/views/modules/Administration/js/Unique.js"></script>
