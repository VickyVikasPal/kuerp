<template>
  
        <breadcrumbs></breadcrumbs>
        <div class="container-fluid">
            <form action="/">
                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{lang.LBL_SEARCH}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_DATE_CREATED}}</label>
                                    <Datepicker id="search.date_sent" v-model.lazy="search.date_sent" :input-class="'form-control'"
                                        :calendar-button="true" :use-utc="false"
                                        :calendar-button-icon="'fa-solid fa-calendar-days'"></Datepicker>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_EMAIL_STATUS}}</label>
                                    <select id="search.status" v-model.lazy="search.status" class="form-select">
                                        <option selected="" value="">-None-</option>
                                        <option value="key">{{value}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_SUBJECT}}</label>
                                    <input type="text" id="search.subject" v-model.lazy="search.subject" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button type="button" @click="getEmails" class="btn btn-success btn-sm">Save</button>
                        <button type="button" @click="clearSearch" class="btn btn-warning btn-sm">Cancel</button>
                    </div>
                </div>
            </form>
            <div class="card mb-2">
                <div class="card-header">
                    <h3>{{lang.LBL_EMAIL_LIST}}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped m-0 item_table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" /></th>
                                    <th>Subject</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Date Sent</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item) in emailList">
                                    <td><input type="checkbox" /></td>
                                    <td>
                                        <router-link :to="'/modules/emails/' + item.id + '/detail'">{{item.subject}}
                                        </router-link>
                                    </td>
                                    <td>
                                        <router-link :to="'/modules/emails/' + item.id + '/detail'">{{item.fromname}}
                                        </router-link>
                                    </td>
                                    <td>
                                        <router-link :to="'/modules/emails/' + item.id + '/detail'">{{item.to}}
                                        </router-link>
                                    </td>
                                    <td>
                                        {{item.date_sent}}
                                    </td>
                                    <td>
                                        {{item.status}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="d-flex justify-content-end align-items-center">
                                <button :class="pagination.currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : ''"
                                    :disabled="pagination.currentPage <= 1"
                                    class="pagination-link btn btn-secondary btn-sm" type="button"
                                    @click="changePage(pagination.currentPage - 1)">
                                    <i class="fa-solid fa-angle-left"></i>
                                </button>
                                <span class="mx-2">
                                    <span>{{ (pagination.perPage * pagination.currentPage) - pagination.perPage + 1
                                        }}</span>
                                    to
                                    <span>{{ pagination.perPage * pagination.currentPage <= pagination.total ?
                                            pagination.perPage * pagination.currentPage : pagination.total }}</span>
                                            of
                                            <span>{{ pagination.total }}</span>
                                    </span>
                                    <button
                                        :class="pagination.currentPage >= pagination.totalPages ? 'opacity-50 cursor-not-allowed' : ''"
                                        :disabled="pagination.currentPage >= pagination.totalPages"
                                        class="ml-3 pagination-link btn btn-secondary btn-sm" type="button"
                                        @click="changePage(pagination.currentPage + 1)">
                                        <i class="fa-solid fa-angle-right"></i>
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  

</template>
<script src="@/views/modules/Emails/js/ListView.js"></script>