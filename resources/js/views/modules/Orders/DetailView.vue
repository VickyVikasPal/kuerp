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
                        <td class="w-30 label">Product Name</td>
                        <td>:</td>
                        <td class="w-70">Product 1</td>
                     </tr>
                     <tr>
                        <td class="w-30 label">Vendor Name</td>
                        <td>:</td>
                        <td class="w-70">Abhay Pratap</td>
                     </tr>
                  </table>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                  <table class="table m-0 detail-item-table">
                     <tr>
                        <td class="w-30 label">Bill No.</td>
                        <td>:</td>
                        <td class="w-70">4000/4600-20</td>
                     </tr>
                     <tr>
                        <td class="w-30 label">Bill Date</td>
                        <td>:</td>
                        <td class="w-70">29/06/2023</td>
                     </tr>
                  </table>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                  <table class="table m-0 detail-item-table">
                     <tr>
                        <td class="w-30 label">Date Entered</td>
                        <td>:</td>
                        <td class="w-70">29/06/2023</td>
                     </tr>
                     <tr>
                        <td class="w-30 label">Date Modified</td>
                        <td>:</td>
                        <td class="w-70">29/06/2023</td>
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
                     <td> <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;&nbsp;<b>55349.87</b>
                     </td>
                  </tr>
                  <tr>
                     <td class="label">Total Invoice Value (In Word)</td>
                     <td>Rupees fifty-five thousand three hundred forty-nine and eighty-seven Paise Only</td>
                  </tr>
                  <tr>
                     <td class="label">Total Invoice Quantity</td>
                     <td> <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;&nbsp;<b>107.00</b>
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
                     <td><b>46906.65</b></td>
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
</template>

<script src="@/views/modules/Orders/js/DetailView.js"></script>