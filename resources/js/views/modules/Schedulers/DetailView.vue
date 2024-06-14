<template>
    <div class="container-fluid">
        <div class="card mb-2">
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <table class="table m-0 detail-item-table" style="width:100%;">
                            <tbody>
                                <tr>
                                    <td class="w-30 label">Job</td>
                                    <td>:</td>
                                    <td class="w-70">{{scheduler.job}}</td>
                                </tr>
                                <tr>
                                    <td class="w-30 label">Status</td>
                                    <td>:</td>
                                    <td class="w-70">{{scheduler.status}}</td>
                                </tr>
                                <tr>
                                    <td class="w-30 label">Date &amp; Time Start</td>
                                    <td>:</td>
                                    <td class="w-70">{{scheduler.date_time_start}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <table class="table m-0 detail-item-table" style="width:100%;">
                            <tbody>
                                <tr>
                                    <td class="w-30 label">Active From</td>
                                    <td>:</td>
                                    <td class="w-70">Always</td>
                                </tr>
                                <tr>
                                    <td class="w-30 label">Date &amp; Time End</td>
                                    <td>:</td>
                                    <td class="w-70">perpetual</td>
                                </tr>
                                <tr>
                                    <td class="w-30 label">Active To</td>
                                    <td>:</td>
                                    <td class="w-70">Always</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <table class="table m-0 detail-item-table" style="width:100%;">
                            <tbody>
                                <tr>
                                    <td class="w-30 label">Last Successful Run</td>
                                    <td>:</td>
                                    <td class="w-70">Never</td>
                                </tr>
                                <tr>
                                    <td class="w-30 label">Interval</td>
                                    <td>:</td>
                                    <td class="w-70"> As often as possible.</td>
                                </tr>
                                <tr>
                                    <td class="label w-35">Execute If Missed</td>
                                    <td>:</td>
                                    <td class="w-70">Always</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <table class="table m-0 detail-item-table" style="width:100%;">
                            <tbody>
                                <tr>
                                    <td class="label w-35">Date Created:</td>
                                    <td>:</td>
                                    <td class="w-70">{{scheduler.date_entered}}</td>
                                </tr>
                                <tr>
                                    <td class="label w-35">Last Modified:</td>
                                    <td>:</td>
                                    <td class="w-70">{{scheduler.date_modified}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header">
                <h3>{{lang.LBL_JOB_LOG}}</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped m-0 item_table">
                        <thead>
                            <tr>
                                <th>Execute Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in schedulerList">
                                <td>{{item.execute_time}}</td>
                                <td>{{item.status}}</td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
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
                                        {{ $t('to') }}
                                        <span>{{ pagination.perPage * pagination.currentPage <= pagination.total ?
                                                pagination.perPage * pagination.currentPage : pagination.total }}</span>
                                                {{ $t('of') }}
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
        <div class="side_buttons" v-bind:class="{ active: isActive }" v-on:click="openAction">
            <span class="more_btn">
                <i class="fa-solid fa-angle-right"></i>
            </span>
            <router-link :to="`/modules/schedulers/edit/${schedulerId}`" class="btn btn-secondary btn-sm">Edit
            </router-link>
            <button type="button" id="duplicate" class="btn btn-secondary btn-sm">Duplicate</button>
            <button type="button" id="delete" class="btn btn-secondary btn-sm">Delete</button>
        </div>
    </div>
</template>

<script src="@/views/modules/Schedulers/js/DetailView.js"></script>