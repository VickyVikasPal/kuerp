<template>
     <div class="container-fluid">
        <div class="card mb-2">
            <div class="card-header">
                <h3>{{lang.LBL_DEFAULT_SEARCH}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group item-select">
                            <label>{{lang.LBL_USER_TYPE}}</label>
                            <input type="text" class="form-control" name="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group item-select">
                            <label>{{lang.LBL_REPORT_GROUP}}</label>
                            <input type="text" class="form-control" name="">
                        </div>
                    </div>
                     <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group item-select">
                            <label>{{lang.LBL_REPORT_NAME}}</label>
                            <input type="text" class="form-control" name="">
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-success btn-sm">Search</button>
                <button type="button" class="btn btn-warning btn-sm">Clear</button>
            </div>
        </div>
        <div class="card mb-2">
            <div class="card-header">
                <h3>{{lang.LBL_REPORT_AUTHS}}</h3>
            </div>
            <div class="card-body">
                <div class="table-reponsive">
                    <table class="table table-bordered table-striped m-0 item_table">
                        <thead>
                            <tr>
                                <th><input type="checkbox"/></th>
                                <th>User Typee</th>
                                <th>Report Group </th>
                                <th>Report Name</th>
                                <th width="50%">Report Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox"/></td>
                                <td>
                                    <router-link to="/modules/reportauths/1/detail">Finance</router-link>
                                </td>
                                <td>Collection Report</td>
                                <td>Payment Receipt Detail</td>
                                <td>
                                    <p><b>Report:Payment Receipt Detail</b></p>
                                    <p>This report displays total payment collected by the bill desk users in the selected Date range. Search filters provided.</p>
                                    <p><b>Date Range :</b> on the basis of Receipt Date</p>
                                    <p><b>Related To :</b> Search for Payment receipts of OPD / IPD / Patients / Emergency</p>
                                    <p><b>Received By :</b> Search for particular front desk user who received the payment</p>
                                    <p><b>Payment Mode :</b> Search for payment mode (Cash / Cheque / Credit/Debit Card / DD ).</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="import-file d-flex align-items-center">
                            <select class="form-select form-select-sm me-2">
                                <option value="">Select</option> 
                                <option value="all">All Records</option> 
                                <option value="none">None</option>
                            </select> 
                            <button class="btn btn-secondary btn-sm">Export</button>
                        </div>
                    </div> 
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="d-flex justify-content-end align-items-center">
                            <button disabled="disabled" type="button" class="btn btn-secondary btn-sm">
                                <i class="fa-solid fa-angle-left"></i>
                            </button> 
                            <span class="mx-2"><span>1</span> to <span>0</span> of <span>0</span></span> 
                            <button disabled="disabled" type="button" class="ml-3 btn btn-secondary btn-sm">
                                <i class="fa-solid fa-angle-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="@/views/modules/ReportAuths/js/ListView.js"></script>