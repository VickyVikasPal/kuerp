<template>
   <div class="container-fluid">
        <div class="card mb-2">
            <div class="card-header">
                <h3>Search</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Customer name</label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Vendor Name</label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Invoice / Bill No.</label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Bill Date</label>
                            <Datepicker :calendar-button-icon="'fa-solid fa-calendar-days'"></Datepicker>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-success btn-sm">Search</button>
                <button type="button" class="btn btn-warning btn-sm">Cancel</button>
            </div>
        </div>
        <div class="card mb-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>List View</h3>
                <span>
                    <router-link to="/modules/quotations/edit" class="btn btn-primary btn-sm rounded-pill">Create Quotations</router-link>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped m-0 item_table">
                        <thead>
                            <tr>
                                <th width="50px">{{lang.LBL_SERIAL_NO}}</th>
                                <th>{{lang.LBL_QUOTATION_NO}}</th>
                                <th>{{lang.LBL_CUSTOMER_NAME}}</th>
                                <th>{{lang.LBL_DELIVERY_NO}}</th>
                                <th>{{lang.LBL_INVOICE_NO}}</th>
                                <th>{{lang.LBL_QUOTATION_DATE}}</th>
                                <th>{{lang.LBL_QUOTATION_AMOUNT}}</th>
                                <th>{{lang.LBL_STATUS}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(qtnData, index) in productList" :key="index">
                                <td>{{index+1}}</td>
                                <td>
                                    <router-link :to="`/modules/quotations/${qtnData.id}/detail`">{{qtnData.quotation_no}}</router-link>
                                </td>
                                <td>{{qtnData.client_master.firm_name}}</td>
                                <td>{{qtnData.delivery_no}}</td>
                                <td>{{qtnData.invoice_no}}</td>
                                <td>{{qtnData.quotation_date}}</td>
                                <td>{{qtnData.grand_total}}</td>
                                <td>{{qtnData.status}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
         
        </div>
   </div>
 </template>
 
 <script src="@/views/modules/Quotations/js/ListView.js"></script>
 