<template>
    <div class="container-fluid">
        
        <div class="card mb-2">
            <div class="card-header">
                <h3>Create View</h3>
            </div>
            <form @submit.prevent="uploadCSV"  enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Select File</label>
                            <input type="file" class="form-control" :name="csvFile" :id="csvFile" ref="csvfile">
                           
                        </div>
                    </div>
                   <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label class="d-block">Excel Template</label>
                            <a href="../../../../assets/ExcelTemplates/Product_Template.csv" download="Product_Template.csv" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i> Download</a>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success btn-sm" value="Submit">Submit</button>
                <a href="/modules/bulkinventorys" class="btn btn-warning btn-sm">Cancel</a>
            </div>
            </form>
        </div>
    </div>
 </template>
 
 <script src="@/views/modules/BulkInventorys/js/NewView.js"></script>
 