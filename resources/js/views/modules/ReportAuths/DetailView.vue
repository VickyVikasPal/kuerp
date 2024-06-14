<template>
  
    <div class="container-fluid">
       <div class="card mb-2">
           <div class="card-header">
               <h3>{{lang.LBL_DETAIL_VIEW}}</h3>
           </div>
           <div class="card-body">
               <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                        <table class="table m-0 detail-item-table">
                            <tr>
                                <td class="w-30 label">User Type</td> 
                                <td>:</td> 
                                <td class="w-70">Finance</td>
                            </tr>
                            <tr>
                                <td class="w-30 label">Report Name</td> 
                                <td>:</td> 
                                <td class="w-70">Payment Receipt Detail</td>
                            </tr>
                            <tr>
                                <td class="w-30 label">Report Group</td> 
                                <td>:</td> 
                                <td class="w-70">Collection Report</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                        <table class="table m-0 detail-item-table">
                            <tr>
                                <td class="w-30 label">Description</td> 
                                <td>:</td> 
                                <td class="w-70">
                                    <p><b>Report:Payment Receipt Detail</b></p>
                                    <p>This report displays total payment collected by the bill desk users in the selected Date range. Search filters provided.</p>
                                    <p><b>Date Range :</b> on the basis of Receipt Date</p>
                                    <p><b>Related To :</b> Search for Payment receipts of OPD / IPD / Patients / Emergency</p>
                                    <p><b>Received By :</b> Search for particular front desk user who received the payment</p>
                                    <p><b>Payment Mode :</b> Search for payment mode (Cash / Cheque / Credit/Debit Card / DD ).</p>
                                </td>
                            </tr>
                           
                        </table>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                        <table class="table m-0 detail-item-table">
                            <tr>
                                <td class="w-30 label">Date Created</td> 
                                <td>:</td> 
                                <td class="w-70">10/05/2023 05:01PM by</td>
                            </tr>
                            <tr>
                                <td class="w-30 label">Date Modified</td> 
                                <td>:</td> 
                                <td class="w-70">10/05/2023 05:01PM by</td>
                            </tr>
                        </table>
                    </div>
               </div>
           </div>
       </div>


       <div class="side_buttons" v-bind:class="{ active: isActive }" v-on:click="openAction">
            <span class="more_btn">
                <i class="fa-solid fa-angle-right"></i>
            </span> 
            <button type="button" id="edit" class="btn btn-secondary btn-sm">Edit</button>
            <button type="button" id="delete" class="btn btn-secondary btn-sm">Duplicate</button>
            <button type="button" id="delete" class="btn btn-secondary btn-sm">Delete</button>
        </div>

    </div>
   
    
</template>
<script src="@/views/modules/ReportAuths/js/DetailView.js"></script>