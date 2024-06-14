<template lang="">

        <breadcrumbs></breadcrumbs>
        <div class="container-fluid">
           
            <div class="card mb-2">
                <div class="card-header">
                    <h3>{{lang.LBL_PRINT_FILE}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_PRINT_FILE}}<span class="required">*</span></label>
                                <select class="form-select">
                                    <option value="0">Select</option>
                                    <option value="admissionslip">Admission Sheet</option>
                                    <option value="casestudy">Case Studty</option>
                                    <option value="beddetails">Bed Transfer Print</option>
                                    <option value="paymentbatch">Batch Collection</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_FROM_PDF}}<span class="required">*</span></label>
                                <select class="form-select" disabled>
                                    <option value="0">Select</option>
                                    <option value="admissionslip">Admission Sheet</option>
                                    <option value="casestudy">Case Studty</option>
                                    <option value="beddetails">Bed Transfer Print</option>
                                    <option value="paymentbatch">Batch Collection</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_FROM_SAVEPRINT}}<span class="required">*</span></label>
                                <select class="form-select" disabled>
                                    <option value="0">Select</option>
                                    <option value="admissionslip">Admission Sheet</option>
                                    <option value="casestudy">Case Studty</option>
                                    <option value="beddetails">Bed Transfer Print</option>
                                    <option value="paymentbatch">Batch Collection</option>
                                </select>
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
            
        </div>
   
</template>
<script src="@/views/modules/FormatSettings/js/EditCurrent.js"></script>