<template>
   
    <div class="container-fluid">

        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_USER_TYPE}}</label>
                                    <select id="schedule" class="form-select" name="schedule">
                                        <option value="Finance">Finance</option>
                                        <option value="Kitchen">Kitchen</option>
                                        <option value="Front Desk">Front Desk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 border-start">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_DEFAULT_REPORT}}</label>
                                    <select id="schedule" class="form-select" name="schedule">
                                        <option value="Finance">Finance</option>
                                        <option value="Kitchen">Kitchen</option>
                                        <option value="Front Desk">Front Desk</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-4 col-sm-6 col-12">
                                <div class="mt-4">
                                    <button type="button" class="btn btn-primary btn-sm">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
       
       <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-resposive mb-2">
                    <table class="table table-bordered table-striped m-0 item_table">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Report Group</th>
                                <th>Report</th>
                                <th>Report Description</th>
                            </tr>
                        </thead>
                    </table>
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

<script src="@/views/modules/ReportAuths/js/EditView.js"></script>