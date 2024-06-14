<template>
<main>
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
                        <td class="w-30 label">{{lang.LBL_FIRM_NAME}}</td>
                        <td>:</td>
                        <td class="w-70">{{customer.firm_name}}</td>
                     </tr>
                     <tr>
                        <td class="w-30 label">{{lang.LBL_CUSTOMER_NAME}}</td>
                        <td>:</td>
                        <td class="w-70">{{customer.name}}</td>
                     </tr>
                  </table>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                  <table class="table m-0 detail-item-table">
                     <tr>
                        <td class="w-30 label">{{lang.LBL_INVOICE_NO}}</td>
                        <td>:</td>
                        <td class="w-70">{{invoice.invoice_no}}</td>
                     </tr>
                     <tr>
                        <td class="w-30 label">{{lang.LBL_INVOICE_DATE}}</td>
                        <td>:</td>
                        <td class="w-70">{{invoice.invoice_date}}</td>
                     </tr>
                  </table>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                  <table class="table m-0 detail-item-table">
                     <tr>
                        <td class="w-30 label">{{lang.LBL_PAYMENT_DATE}}</td>
                        <td>:</td>
                        <td class="w-70">{{invoice.payment_date}}</td>
                     </tr>
                     <tr>
                        <td class="w-30 label">{{lang.LBL_PAYMENT_STATUS}}</td>
                        <td>:</td>
                        <td class="w-70"><button class="btn btn-sm" :style="'background-color:'+pmtStatus+'; color: #fff;'">{{invoice.payment_status}}</button></td>
                     </tr>
                  </table>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                  <table class="table m-0 detail-item-table">
                     <tr>
                        <td class="w-30 label">{{lang.LBL_DATE_ENTERED}}</td>
                        <td>:</td>
                        <td class="w-70">{{invoice.date_entered}}</td>
                     </tr>
                     <tr>
                        <td class="w-30 label">{{lang.LBL_DATE_MODIFY}}</td>
                        <td>:</td>
                        <td class="w-70">{{invoice.date_modified}}</td>
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
                     <td class="label">{{lang.LBL_TOTAL_INVOICE_VALUE}}</td>
                     <td> <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;&nbsp;<b>{{grandTotal}}</b>
                     </td>
                  </tr>
                  <tr>
                     <td class="label">{{lang.LBL_TOTAL_INVOICE_VALUE_WORD}}</td>
                     <td>Rupees {{grandTotal_W}}</td>
                  </tr>
                  <tr>
                     <td class="label">{{lang.LBL_TOTAL_INVOICE_QTY}}</td>
                     <td> <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;&nbsp;<b>{{totalQty}}</b>
                     </td>
                  </tr>
                  <tr>
                     <td class="label">{{lang.LBL_EWAY_BILL_NO}}</td>
                     <td></td>
                  </tr>
                  <tr>
                     <td class="label">{{lang.LBL_EWAY_BILL_DATE}}</td>
                     <td></td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <table class="table table-bordered detail-item-table text-end m-0">
               <tbody>
                  <tr>
                     <td class="label">{{lang.LBL_TOTAL_AMT_BEFORE_TAX}}</td>
                     <td><b>{{TotalTaxable}}</b></td>
                  </tr>
                <!--  <tr>
                     <td class="label">{{lang.LBL_FREIGHT}}</td>
                     <td>0.00</td>
                  </tr>!-->
                  <tr>
                     <td class="label">{{lang.LBL_SUB_TOTAL}}</td>
                     <td>{{TotalTaxable}}</td>
                  </tr>
                <!--  <tr>
                     <td class="label">{{lang.LBL_FREIGHT_TAX}}</td>
                     <td>0.00</td>
                  </tr>!-->
                  <tr>
                     <td class="label">{{lang.LBL_CGST}}</td>
                     <td>{{cgstAmt}}</td>
                  </tr>
                  <tr>
                     <td class="label">{{lang.LBL_SGST}}</td>
                     <td>{{sgstAmt}}</td>
                  </tr>
                  <tr>
                     <td class="label">{{lang.LBL_IGST}}</td>
                     <td>{{igstAmt}}</td>
                  </tr>
                  <tr>
                     <td class="label">{{lang.LBL_GST_AMOUNT}}</td>
                     <td>{{gstAmount}}</td>
                  </tr>
                <!--  <tr>
                     <td class="label">{{lang.LBL_ROUNDING}}</td>
                     <td>{{totalRounding}}</td>
                  </tr>!-->
                  <tr>
                     <td class="label">{{lang.LBL_TOTAL_AMT_AFTER_TAX}}</td>
                     <td><b>{{grandTotal}}</b></td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>

</main>
</template>

<script src="@/views/modules/Invoices/js/DetailView.js"></script>