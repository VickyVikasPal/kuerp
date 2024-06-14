<template lang="">
  
        <breadcrumbs></breadcrumbs>
        <div class="container-fluid">
            <form @submit.prevent="saveEmail" enctype="multipart/form-data">
                <div class="card mb-2">
                    <div class="card-header">
                        <h3 for="">{{lang.LBL_EMAIL_OPTIONS}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fromname">{{lang.LBL_FROM_NAME}}<span class="required">*</span></label>
                                    <input type="text" class="form-control" id="fromname" v-model="emails.fromname">
                                    <input type="hidden" id="fieldValue" v-model="emails.id">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fromaddress">{{lang.LBL_FROM_ADDRESS}}<span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" id="fromaddress"
                                        v-model="emails.fromaddress">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="smtpserver">{{lang.LBL_SMTP_SERVE}}<span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" id="smtpserver" v-model="emails.smtpserver">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="smtpport">{{lang.LBL_SMTP_PORT}}<span class="required">*</span></label>
                                    <input type="text" class="form-control" id="smtpport" v-model="emails.smtpport">
                                </div>
                            </div>
                            <!--  <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-check">
                                    <input type="checkbox" id="check1" value="true" checked="checked" class="form-check-input"> 
                                    <label for="check1" class="form-check-label" for="">{{lang.LBL_SMTP_AUTH}}</label>
                                </div> 
                                <div class="form-check">
                                    <input type="checkbox" id="check2" value="true" checked="checked" class="form-check-input"> 
                                    <label for="check2" class="form-check-label" for="">{{lang.LBL_ENABLE_SMTP}}</label>
                                </div>
                            </div> -->
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="smtpuser">{{lang.LBL_SMTP_USERNAME}}<span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" id="smtpuser" v-model="emails.smtpuser">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="smtppassword">{{lang.LBL_SMTP_PASSWORD}}<span
                                            class="required">*</span></label>
                                    <input type="password" class="form-control" id="smtppassword"
                                        v-model="emails.smtppassword">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-body text-end">
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                        <button type="button" class="btn btn-warning btn-sm">Cancel</button>
                    </div>
                </div>
            </form>
        </div>

</template>
<script src="@/views/modules/Emails/js/EditView.js"></script>