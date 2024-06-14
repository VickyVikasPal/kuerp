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
                            <label>Vendor Name</label>
                            <input type="text" class="form-control" value="">
                            <span class="group-select">
                                <span> <i class="fa-solid fa-user-plus"></i></span>
                                <span> <i class="fa-solid fa-xmark"></i></span>
                            </span>
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
                            <input type="date" class="form-control" value="">
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
                            <label>Item</label>
                            <input type="text" class="form-control" value="">
                            <span class="group-select">
                                <span> <i class="fa-solid fa-user-plus"></i></span>
                                <span> <i class="fa-solid fa-xmark"></i></span>
                            </span>
                        </div>
                       
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                        <div class="form-group mt-3">
                            <button type="button" class="btn btn-primary btn-sm">ADD</button>
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
                                <th width="20px" class="">S.No.</th>
                                <th width="200px">Product Name</th>
                                <th width="200px">Description</th>
                                <th>HSN Code</th>
                                <th>QTY</th>
                                <th>Unit</th>
                                <th>Sale/Unit Price (INR)</th>
                                <th>Total Value (INR)</th>
                                <th>Taxble Value (INR)</th>
                                <th width="200px" class="p-0">
                                    <table class="table m-0 table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2">CGST</th>
                                                <th colspan="2">SGST</th>
                                                <th colspan="2">IGST</th>
                                            </tr>
                                            <tr>
                                                <th width="20px">Rate</th>
                                                <th width="80">Amount</th>
                                                <th width="20px">Rate</th>
                                                <th width="80">Amount</th>
                                                <th width="20px">Rate</th>
                                                <th width="80">Amount</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </th>
                                <th>Total (INR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Product theme</td>
                                <td>JCBTransmissionOilPlus</td>
                                <td>2710</td>
                                <td>40.00 </td>
                                <td>Ltr</td>
                                <td>339.83</td>
                                <td>13593.20</td>
                                <td>11554.40</td>
                                <td width="200px" class="p-0">
                                    <table class="table m-0 table-bordered inner-table">
                                        <tbody>
                                            <tr>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>13634.20</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Product theme</td>
                                <td>JCBTransmissionOilPlus</td>
                                <td>2710</td>
                                <td>40.00 </td>
                                <td>Ltr</td>
                                <td>339.83</td>
                                <td>13593.20</td>
                                <td>11554.40</td>
                                <td width="200px" class="p-0">
                                    <table class="table m-0 table-bordered inner-table">
                                        <tbody>
                                            <tr>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>13634.20</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Product theme</td>
                                <td>JCBTransmissionOilPlus</td>
                                <td>2710</td>
                                <td>40.00 </td>
                                <td>Ltr</td>
                                <td>339.83</td>
                                <td>13593.20</td>
                                <td>11554.40</td>
                                <td width="200px" class="p-0">
                                    <table class="table m-0 table-bordered inner-table">
                                        <tbody>
                                            <tr>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>13634.20</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Product theme</td>
                                <td>JCBTransmissionOilPlus</td>
                                <td>2710</td>
                                <td>40.00 </td>
                                <td>Ltr</td>
                                <td>339.83</td>
                                <td>13593.20</td>
                                <td>11554.40</td>
                                <td width="200px" class="p-0">
                                    <table class="table m-0 table-bordered inner-table">
                                        <tbody>
                                            <tr>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>13634.20</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Product theme</td>
                                <td>JCBTransmissionOilPlus</td>
                                <td>2710</td>
                                <td>40.00 </td>
                                <td>Ltr</td>
                                <td>339.83</td>
                                <td>13593.20</td>
                                <td>11554.40</td>
                                <td width="200px" class="p-0">
                                    <table class="table m-0 table-bordered inner-table">
                                        <tbody>
                                            <tr>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                                <td width="70px">9%</td>
                                                <td width="80px">1039.90</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>13634.20</td>
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
                                    <td><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;&nbsp;<b>55349.87</b> </td>
                                </tr>
                                <tr>
                                    <td class="label">Total Invoice Value (In Word)</td>
                                    <td>Rupees fifty-five thousand three hundred forty-nine and eighty-seven Paise Only</td>
                                </tr>
                                <tr>
                                    <td class="label">Total Invoice Quantity</td>
                                    <td><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;&nbsp;<b>107.00</b></td>
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
                                    <td><b>46906.65</b> </td>
                                </tr>
                                <tr>
                                    <td class="label">Freight</td>
                                    <td>0.00</td>
                                </tr>
                                <tr>
                                    <td class="label">Sub Total</td>
                                    <td>46906.65</td>
                                </tr>
                                <tr>
                                    <td class="label">Freight Tax</td>
                                    <td>0.00</td>
                                </tr>
                                <tr>
                                    <td class="label">CGST</td>
                                    <td>4221.61</td>
                                </tr>
                                <tr>
                                    <td class="label">SGST</td>
                                    <td>4221.61</td>
                                </tr>
                                <tr>
                                    <td class="label">IGST</td>
                                    <td>0.00</td>
                                </tr>
                                <tr>
                                    <td class="label">Tax Amount : GST</td>
                                    <td>8443.22</td>
                                </tr>
                                <tr>
                                    <td class="label">Rounding</td>
                                    <td>0.00</td>
                                </tr>
                                <tr>
                                    <td class="label">Total Amount After Tax</td>
                                    <td><b>55349.87</b></td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body text-end">
                <button type="button" class="btn btn-success btn-sm">Save</button>
                <button type="button" class="btn btn-warning btn-sm">Cancel</button>
            </div>
        </div>
                
         
       
    </div>
 </template>
 
 <script src="@/views/modules/Orders/js/EditView.js"></script>
 