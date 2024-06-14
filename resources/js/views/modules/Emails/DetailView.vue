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
                                            <td><label>{{lang.LBL_DATE_SEND}}</label></td>
                                            <td>{{emailstatus.date_sent}}</td>
                                        </tr>
                                        <tr>
                                            <td><label>{{lang.LBL_FROM_EMAIL}}</label></td>
                                            <td colspan="3">{{emailstatus.fromaddress}}</td>

                                        </tr>
                                        <tr>
                                            <td><label>{{lang.LBL_TO_EMAIL}}</label></td>
                                            <td colspan="3">{{emailstatus.to}}</td>
                                        </tr>
                                        <tr>
                                            <td><label>{{lang.LBL_CC_EMAIL}}</label></td>
                                            <td colspan="3">{{emailstatus.cc}}</td>
                                        </tr>
                                        <tr>
                                            <td><label>{{lang.LBL_BCC_EMAIL}}</label></td>
                                            <td colspan="3">{{emailstatus.bcc}}</td>
                                        </tr>
                                        <tr>
                                            <td><label>{{lang.LBL_EMAIL_SUBJECT}}</label></td>
                                            <td colspan="3">{{emailstatus.subject}}</td>
                                        </tr>
                                        <tr>
                                            <td valign="top"><label>{{lang.LBL_EMAIL_BODY}}</label></td>
                                            <td colspan="3">
                                                {{emailstatus.html}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>{{lang.LBL_EMAIL_ATTACHMENTS}}</label></td>
                                            <td colspan="3">
                                                <a :href="`${emailstatus.attachment}`" target="_blank">{{emailstatus.attachment_name}}</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
   
</template>
<script src="@/views/modules/Emails/js/DetailView.js"></script>