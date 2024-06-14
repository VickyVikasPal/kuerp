<template>
    
    <div class="container-fluid">
        
        <div class="card mb-2">
            <div class="card-header">
                <h3>Create View</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group item-select">
                            <label>{{lang.LBL_CUSTOMER_NAME}}</label>
                            <input type="hidden" name="" id="clientmaster_parent_id" v-model="invoice.client_id" @change="getCustomer(invoice.client_id)">
                                                <input type="hidden" name="" id="clientmaster_parent_type" v-model="invoice.client_type">
                                                <input  type="text" class="form-control" v-model="invoice.client_name" :id="`clientmaster_name`" autocomplete="off" v-on:keyup="queryForKeywords($event, 'clientmaster')" v-on:keydown="queryForKeywords($event, 'clientmaster')"/>
                            <span class="group-select">
                                <span ref="genericSearch"
                                    @click="openComponent('clientmasters', 'ClientMasters')"><i
                                        class="fa-solid fa-user-plus"></i></span>
                                <span @click="clearComponent('clientmaster')"><i
                                        class="fa-solid fa-xmark"></i></span>
                            </span>
                            
                            <ul class="dropdown_type" v-if="showDropdown1">
                                <li v-for="item in dropdownList" :key="item.id" @click="updateItem(item.id,item.name,'clientmaster')">{{item.name}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group item-select">
                            <label>{{lang.LBL_FIRM_NAME}}</label>
                           <!-- <input type="text" class="form-control" value="">
                            <span class="group-select">
                                <span> <i class="fa-solid fa-user-plus"></i></span>
                                <span> <i class="fa-solid fa-xmark"></i></span>
                            </span>!-->
                            
                            <input type="text" class="form-control" v-model="qtn.firm_name" disabled>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{lang.LBL_CONTACT_NO}}</label>
                            <input type="text" class="form-control" v-model="qtn.contact_no" disabled>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{lang.LBL_EMAIL_ID}}</label>
                            <input type="text" class="form-control" v-model="qtn.client_email" disabled>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{lang.LBL_GST_STATUS}}</label>
                            <input type="text" class="form-control" v-model="qtn.gst_status" disabled>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{lang.LBL_GST_NUMBER}}</label>
                            <input type="text" class="form-control" v-model="qtn.gst_number" disabled>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{lang.LBL_AREA}}</label>
                            <input type="text" class="form-control" v-model="qtn.area" disabled>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{lang.LBL_STATE}}</label>
                            <input type="text" class="form-control" v-model="qtn.state" disabled>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{lang.LBL_PIN}}</label>
                            <input type="text" class="form-control" v-model="qtn.pin_no" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <div class="card-body mb-2">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-8 col-8">
                        <div class="form-group item-select">
                            <label>{{lang.LBL_ITEM}}</label>
                            <input type="hidden" name="" id="invoice_id" v-model="invoice_id"/>
                            <input type="hidden" name="" id="product_parent_id" v-model="invoice.product_id">
                            <input type="hidden" name="" id="product_parent_type" v-model="invoice.product_type">
                            <input  type="text" class="form-control" v-model="invoice.product_name" :id="`product_name`" autocomplete="off" v-on:keyup="queryForKeywords($event, 'product')" v-on:keydown="queryForKeywords($event, 'product')"/>
                             <span class="group-select">
                                <span ref="genericSearch"
                                    @click="openComponent('products', 'Products')"><i
                                        class="fa-solid fa-user-plus"></i></span>
                                <span @click="clearComponent('product')"><i
                                        class="fa-solid fa-xmark"></i></span>
                            </span>
                            
                            <ul class="dropdown_type" v-if="showDropdown2">
                                <li v-for="item in dropdownList" :key="item.id" @click="updateItem(item.id,item.name,'product')">{{item.name}}</li>
                            </ul>
                        </div>
                       
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                        <div class="form-group">
                            <label>Discount <small>(If any add in  %)</small></label>
                            <input type="text" id="discount" class="form-control" value="0"/>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                        <div class="form-group">
                           <label>Product Qty</label>
                            <input type="text" id="product_qty" class="form-control" value="0"/>
                        </div>
                         <div class="form-group">
                           <label class="text-danger" v-if="error_qty" >{{erro_qty_msg}}</label>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                        <div class="form-group mt-3">
                            <button type="button" class="btn btn-primary btn-sm" @click="addProduct()">ADD</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
        <div class="row mb-2">
            <div class="col-12">
                <div class="table-responsive">
                    <table cellspacing="0" cepadding="0" class="table table-bordered table-striped m-0 item_table">
                        <thead>
                                <tr>
                                    <th width="20px" class="">{{lang.LBL_SERIAL_NUMBER}}</th>
                                    <th width="200px">{{lang.LBL_PRODUCT_NAME}}</th>
                                    <th>{{lang.LBL_HSN_CODE}}</th>
                                    <th>{{lang.LBL_QUANTITY}}</th>
                                    <th>{{lang.LBL_SALE_UNIT_PRICE}}</th>
                                    <th>{{lang.LBL_TOTAL_VALUE}}</th>
                                    <th>{{lang.LBL_LESS_DISCOUNT_P}}</th>
                                    <th>{{lang.LBL_LESS_DISCOUNT_AMT}}</th>
                                    <th>{{lang.LBL_TAXABLE_VALUE}}</th>
                                    <th width="200px" class="p-0">
                                    <table class="table m-0 table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2">{{lang.LBL_CGST}}</th>
                                                <th colspan="2">{{lang.LBL_SGST}}</th>
                                                <th colspan="2">{{lang.LBL_IGST}}</th>
                                            </tr>
                                            <tr>
                                                <th width="20px">{{lang.LBL_CRATE}}</th>
                                                <th width="80">{{lang.LBL_CAMT}}</th>
                                                <th width="20px">{{lang.LBL_SRATE}}</th>
                                                <th width="80">{{lang.LBL_SAMT}}</th>
                                                <th width="20px">{{lang.LBL_IRATE}}</th>
                                                <th width="80">{{lang.LBL_IAMT}}</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    </th>
                                    <th>{{lang.LBL_TOTAL_INR}}</th>
                                    <th>{{lang.LBL_ACTION}}</th>
                                </tr>
                            </thead>
                        <tbody>
                            <tr v-for="(prod, index) in productArray" :key="index">
                                <td>{{index+1}}</td>
                                <td>{{prod.name}}</td>
                                
                                <td>{{prod.hsn_code}}</td>
                                <td>{{prod.qty}}</td>
                                <td>{{prod.unit_price}}</td>
                               <td>{{prod.total_value}}</td>
                                <td>{{prod.discount}}</td>
                                <td>{{prod.discount_amount}}</td>
                                <td>{{prod.taxable_value}}</td>
                                <td width="200px" class="p-0">
                                    <table class="table m-0 table-bordered inner-table">
                                        <tbody>
                                            <tr>
                                                <td width="70px">{{getRate(prod.tax_type)}}%</td>
                                                <td width="80px">{{prod.cgst}}</td>
                                                <td width="70px">{{getRate(prod.tax_type)}}</td>
                                                <td width="80px">{{prod.sgst}}</td>
                                                <td width="70px">{{prod.tax_type}}</td>
                                                <td width="80px">{{prod.igst}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>{{prod.total_amount}}</td>
                                <td class="text-center"><button  @click="delRecord(prod.id)"><i class="fa fa-trash-alt"></i></button></td>
                            </tr>                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card mb-2">
                    <div class="card-header"><h3>Total Invoices</h3></div>
                    <div class="card-body">
                        <table class="table table-bordered detail-item-table m-0">
                            <tbody>
                                <tr>
                                    <td class="label">Total Invoice Value (In Figure)</td>
                                    <td><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;&nbsp;<b>{{grandTotal}}</b> </td>
                                </tr>
                                <tr>
                                    <td class="label">Total Invoice Value (In Word)</td>
                                    <td>Rupees {{grandTotal_W}}</td>
                                </tr>
                                <tr>
                                    <td class="label">Total Invoice Item Quantity</td>
                                    <td><b>{{totalQty}}</b></td>
                                </tr>
                                <tr>
                                    <td class="label">E-Way Bill No.</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="label">Date of Issue</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card mb-2">
                    <div class="card-header"><h3>Total Bill</h3></div>
                    <div class="card-body">
                        <table class="table table-bordered detail-item-table text-end m-0">
                            <tbody>
                                <tr>
                                    <td class="label">Total Amount Before Tax</td>
                                    <td><b>{{TotalTaxable}}</b> </td>
                                </tr>
                               <!-- <tr>
                                    <td class="label">Freight</td>
                                    <td>0.00</td>
                                </tr>!-->
                                <tr>
                                    <td class="label">Sub Total</td>
                                    <td>{{TotalTaxable}}</td>
                                </tr>
                                <!--<tr>
                                    <td class="label">Freight Tax</td>
                                    <td>0.00</td>
                                </tr>!-->
                                <tr>
                                    <td class="label">CGST</td>
                                    <td>{{cgstAmt}}</td>
                                </tr>
                                <tr>
                                    <td class="label">SGST</td>
                                    <td>{{sgstAmt}}</td>
                                </tr>
                                <tr>
                                    <td class="label">IGST</td>
                                    <td>{{igstAmt}}</td>
                                </tr>
                                <tr>
                                    <td class="label">Tax Amount : GST</td>
                                    <td>{{gstAmount}}</td>
                                </tr>
                               <!-- <tr>
                                    <td class="label">Rounding</td>
                                    <td>{{totalRounding}}</td>
                                </tr>!-->
                                <tr>
                                    <td class="label">Total Amount After Tax</td>
                                    <td><b>{{grandTotal}}</b></td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body text-end">
                <button type="button" class="btn btn-success btn-sm" @click="updateInvoice('save')">Save</button>
                <button type="button" class="btn btn-warning btn-sm" @click="updateInvoice('cancel')">Cancel</button>
            </div>
        </div>
                
         
       
    </div>
    
 </template>
 
 <script src="@/views/modules/Invoices/js/EditView.js"></script>
 