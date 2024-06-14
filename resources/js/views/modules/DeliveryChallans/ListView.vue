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
                            <label>{{lang.LBL_CUSTOMER_NAME}}</label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{lang.LBL_CONTACT_NO}}</label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{lang.LBL_INVOICE_BILL}}</label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{lang.LBL_BILL_DATE}}</label>
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
                    <router-link to="/modules/deliverychallans/edit" class="btn btn-primary btn-sm rounded-pill">Create Delivery Challan</router-link>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped m-0 item_table">
                        <thead>
                            <tr>
                                <th width="50px">{{lang.LBL_SERIAL_NO}}</th>
                                <th>{{lang.LBL_DELIVEY_NO}}</th>
                                <th>{{lang.LBL_CUSTOMER_NAME}}</th>
                                <th>{{lang.LBL_BILL_AMOUNT}}</th>
                                <th>{{lang.LBL_BILL_DATE}}</th>
                                <th>{{lang.LBL_DELIVERY_STATUS}}</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <router-link to="/modules/deliverychallans/1/detail">Invoice one</router-link>
                                </td>
                                <td>Abhay Pratap</td>
                                <td>4000/4600-20</td>
                                <td>29/06/2023</td>
                                <td>4000/4600-20</td>
                                
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <router-link to="/modules/deliverychallans/2/detail">Invoice one</router-link>
                                </td>
                                <td>Abhay Pratap</td>
                                <td>4000/4600-20</td>
                                <td>29/06/2023</td>
                                <td>4000/4600-20</td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
         
        </div>
   </div>
 </template>
 
 <script src="@/views/modules/DeliveryChallans/js/ListView.js"></script>
 