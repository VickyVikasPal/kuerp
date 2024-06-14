<template>
    <main>
        <breadcrumbs></breadcrumbs>
        <div class="container-fluid">
            <form action="/">
                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{lang.LBL_GLOBAL_SEARCH}}</h3>
                    </div>
                    <div class="card-body">
                         <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_PRINT_FILE}}</label>
                                    <select class="form-select">
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
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-success btn-sm">Search</button>
                        <button type="button" class="btn btn-warning btn-sm">Clear</button>
                    </div>
                </div>
            </form>
          
            <div class="card mb-2">
                <div class="card-header">
                    <h3>{{lang.LBL_PRINT_SIZE_LIST}}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped m-0 item_table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox"/></th>
                                    <th>Print File</th>
                                    <th>From PDFs</th>
                                    <th>From Save&Print</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox"/></td>
                                    <td>MLC Form</td>
                                    <td>A4</td>
                                    <td>A4</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="import-file d-flex align-items-center">
                                <select class="form-select form-select-sm me-2">
                                    <option value="">Select</option> 
                                    <option value="all">All Records</option> 
                                    <option value="none">None</option>
                                </select> 
                                <button class="btn btn-secondary btn-sm">Export</button>
                            </div>
                        </div> 
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="d-flex justify-content-end align-items-center">
                                <button disabled="disabled" type="button" class="btn btn-secondary btn-sm">
                                    <i class="fa-solid fa-angle-left"></i>
                                </button> 
                                <span class="mx-2"><span>1</span> to <span>0</span> of <span>0</span></span> 
                                <button disabled="disabled" type="button" class="ml-3 btn btn-secondary btn-sm">
                                    <i class="fa-solid fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

</template>
<script src="@/views/modules/FormatSettings/js/ListCurrent.js"></script>