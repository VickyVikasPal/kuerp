<template>
    <breadcrumbs></breadcrumbs>
    <div class="container-fluid">
        <form action="/">
            <div class="card mb-2">
                <div class="card-header">
                    <h3>{{lang.LBL_ADD_PRINT}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_PRINT_SIZE}}<span class="required">*</span></label>
                                <select class="form-select">
                                    <option value="A4">A4</option>
                                    <option value="A5">A5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_PRINT_OPTION}}<span class="required">*</span></label>
                                <select class="form-select">
                                    <option value="0">Select Print Option</option>
                                    <option value="1">Print option 1</option>
                                    <option value="2">Print option 1</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_PRINT_HEADER}}</label>
                                <div class="form-check">
                                    <input type="checkbox" id="check1" name="option1" value="" class="form-check-input"> 
                                    <label for="check1" class="form-check-label"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_PRINT_FOOTER}}</label>
                                <div class="form-check">
                                    <input type="checkbox" id="check2" name="option1" value="" class="form-check-input"> 
                                    <label for="check2" class="form-check-label"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_TOP_MARGIN}}<span class="required">*</span></label>
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_BOTTOM_MARGIN}}<span class="required">*</span></label>
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_LEFT_MARGIN}}<span class="required">*</span></label>
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_RIGHT_MARGIN}}<span class="required">*</span></label>
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_HEADER_MARGIN}}<span class="required">*</span></label>
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_FOOTER_MARGIN}}<span class="required">*</span></label>
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_BARCODE_MARGIN}}<span class="required">*</span></label>
                                <input type="text" class="form-control" name="">
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
<script src="@/views/modules/FormatSettings/js/EditView.js"></script> 