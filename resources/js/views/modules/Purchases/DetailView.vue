<template>
   <div class="container-fluid">
      <div class="card mb-2">
         <div class="card-header">
            <h3>Detail View</h3>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                  <table class="table m-0 detail-item-table">
                      <tr>
                        <td class="w-30 label">{{lang.LBL_VENDOR_NAME}}</td>
                        <td>:</td>
                        <td class="w-70">{{product.vendor_name}}</td>
                     </tr>
                     <tr>
                        <td class="w-30 label">{{lang.LBL_STATUS}}</td>
                        <td>:</td>
                        <td class="w-70">{{product.status}}</td>
                     </tr>                     
                  </table>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                  <table class="table m-0 detail-item-table">
                     <tr>
                        <td class="w-30 label">{{lang.LBL_BILL_NUMBER}}</td>
                        <td>:</td>
                        <td class="w-70">{{product.bill_no}}</td>
                     </tr>
                     <tr>
                        <td class="w-30 label">{{lang.LBL_BILL_NUMBER}}</td>
                        <td>:</td>
                        <td class="w-70">{{product.bill_date}}</td>
                     </tr>
                  </table>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                  <table class="table m-0 detail-item-table">
                     <tr>
                        <td class="w-30 label">{{lang.LBL_DATE_ENTERED}}</td>
                        <td>:</td>
                        <td class="w-70">{{product.date_entered}}</td>
                     </tr>
                     <tr>
                        <td class="w-30 label">{{lang.LBL_DATE_MODIFY}}</td>
                        <td>:</td>
                        <td class="w-70">{{product.date_modified}}</td>
                     </tr>
                  </table>
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
                        <th>HSN Code</th>
                        <th>QTY</th>
                        <th>Sale/Unit Price (INR)</th>
                        <th>Total Value (INR)</th>
                        <th>Less Discount (%)</th>
                        <th>Less Discount (Amt)</th>
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
                            </tr>
                     
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <table class="table table-bordered detail-item-table m-0">
               <tbody>
                  <tr>
                     <td class="label">Total Invoice Value (In Figure)</td>
                     <td> <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;&nbsp;<b>{{grandTotal}}</b>
                     </td>
                  </tr>
                  <tr>
                     <td class="label">Total Invoice Value (In Word)</td>
                     <td>Rupees {{grandTotal_W}}</td>
                  </tr>
                  <tr>
                     <td class="label">Total Invoice Quantity</td>
                     <td> <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;&nbsp;<b>{{totalQty}}</b>
                     </td>
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
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <table class="table table-bordered detail-item-table text-end m-0">
               <tbody>
                  <tr>
                     <td class="label">Total Amount Before Tax</td>
                     <td><b>{{TotalTaxable}}</b></td>
                  </tr>
                  <tr>
                     <td class="label">Freight</td>
                     <td>0.00</td>
                  </tr>
                  <tr>
                     <td class="label">Sub Total</td>
                     <td>{{TotalTaxable}}</td>
                  </tr>
                  <tr>
                     <td class="label">Freight Tax</td>
                     <td>0.00</td>
                  </tr>
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
                  <tr>
                     <td class="label">Rounding</td>
                     <td>{{totalRounding}}</td>
                  </tr>
                  <tr>
                     <td class="label">Total Amount After Tax</td>
                     <td><b>{{grandTotal}}</b></td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</template>

<script src="@/views/modules/Purchases/js/DetailView.js"></script>