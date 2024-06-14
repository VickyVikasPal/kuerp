<template>
   
    <div class="container-fluid">

        <div class="card mb-2">
            <div class="card-header">
                <h3>{{lang.LBL_DEFAULT_SEARCH}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group item-select">
                            <label>{{lang.LBL_DEFAULT_USER}}</label>
                            <input type="text" class="form-control" name="">
                            <span class="group-select">
                                <span><i class="fa-solid fa-user-plus"></i></span> 
                                <span><i class="fa-solid fa-xmark"></i> </span>
                            </span>
                            <ul class="dropdown_type" v-if="dropdown">
                                <li>text</li>
                                <li>text</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group item-select">
                            <label>{{lang.LBL_SCHEDULER}}</label>
                            <select id="schedule" class="form-select" name="schedule">
                                <option value="Daily">Daily</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Monthly">Monthly</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header">
                <h3>{{lang.LBL_DEFAULT_REPORTS}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h3 class="mb-2">Collection Report</h3>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-check">
                            <input type="checkbox" id="check1" name="option1" value="" class="form-check-input"> 
                            <label for="check1" class="form-check-label">Payment Receipt Detail</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body text-end">
                <button type="button" class="btn btn-success btn-sm">Search</button>
                <button type="button" class="btn btn-warning btn-sm">Cancel</button>
            </div>
        </div>
        
    </div>
    
</template>

<script src="@/views/modules/UserReports/js/EditView.js"></script>