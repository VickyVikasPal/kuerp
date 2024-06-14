<template lang="">

        <breadcrumbs></breadcrumbs>
       <div class="container-fluid">
           <div class="card mb-2">
               <div class="card-header">
                   <h3>{{lang.LBL_SEND_EMAILS}}</h3>
               </div>
               <div class="card-body">
                   <div class="row">
                       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="table-responsive">
                            <table class="table table-bordered table-striped m-0 item_table">
                                <tbody>
                                    <tr>
                                        <td><label>{{lang.LBL_ASSIGNED_TO}}</label></td>
                                        <td>Softdev Admin</td>
                                        <td><label>{{lang.LBL_DATE_SEND}}</label></td>
                                        <td>25/04/2023 02:13PM</td>
                                    </tr>
                                    <tr>
                                        <td><label>{{lang.LBL_FROM_EMAIL}}</label></td>
                                        <td colspan="3">test@Softdevinfo.com</td>
                                       
                                    </tr>
                                    <tr>
                                        <td><label>{{lang.LBL_TO_EMAIL}}</label></td>
                                        <td colspan="3">mohit.sharma@Softdevinfo.com</td>
                                    </tr>
                                    <tr>
                                        <td><label>{{lang.LBL_CC_EMAIL}}</label></td>
                                        <td colspan="3">Softdev Admin</td>
                                    </tr>
                                    <tr>
                                        <td><label>{{lang.LBL_BCC_EMAIL}}</label></td>
                                        <td colspan="3">Softdev Admin</td>
                                    </tr>
                                    <tr>
                                        <td><label>{{lang.LBL_EMAIL_SUBJECT}}</label></td>
                                        <td colspan="3">Your OHC Health Check-up scheduled on 25/04/2023</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><label>{{lang.LBL_EMAIL_BODY}}</label></td>
                                        <td colspan="3">
                                            Dear Akhyajit Phukan .,<br>
                                            <br>
                                            Your Health Check-up is schedule on date 25/04/2023. 
                                            <br>
                                            Kindly attend the health check-up.
                                            <br>
                                            <br>
                                            Thanks &amp; Regards
                                            <br>
                                            OHC Team
                                            <br>
                                            Intercom: 3700
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>{{lang.LBL_EMAIL_ATTACHMENTS}}</label></td>
                                        <td colspan="3">
                                            <a href="javascript:void(0);">Labreport.pdf</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                           </div>
                           
                       </div>
                   </div>
               </div>
               <div class="card-footer">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="d-flex justify-content-end align-items-center">
                            <button disabled="disabled" type="button" class="btn btn-secondary btn-sm">
                                 <i class="fa-solid fa-angle-left"></i> 
                            </button>
                            <span class="mx-2"><span>1</span> to <span>1</span>  of <span>1</span></span> 
                            <button disabled="disabled" type="button"
                                class="ml-3 btn btn-secondary btn-sm">
                                 <i class="fa-solid fa-angle-right"></i> 
                            </button>
                        </div>
                    </div>
                </div>
            </div>
           </div>
       </div>
    
</template>
<script src="@/views/modules/Emails/js/DetailView.js"></script>