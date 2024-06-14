<template>
    <main>
        <breadcrumbs/>
        <div class="container-fluid">
            <div class="card index-card mb-2">
                <div class="card-header">
                    <h3><i class="fa-solid fa-angles-right"></i>&nbsp;{{'Mis Report form view'}}</h3>
                </div>
                
                <div class="card-body">
                    <div class="row">
                       

                    <input type="hidden" id="reportName" name="reportName" :value="reportName"/>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12" v-for="(item, index) in htmlContent" :key="index">
                            <div class="form-group">
                                <template v-if="item.required">
                                    <label>{{item.lable}}<span class="error">*</span></label>
                                    <template v-if="item.type == 'select'">
                                        <select :id="item.name" v-model="FormData[item.name]"  class="form-select required">
                                        <option value="">Select</option>
                                        
                                        </select>
                                    </template>
                                </template>


                                <template v-else>
                                    <label>{{item.lable}}</label>
                                    <template v-if="item.type == 'select'">
                                        <select :id="item.name" v-model="FormData[item.name]"  class="form-select">
                                        <option value="">Select</option>
                                        
                                        </select>
                                </template>
                                </template>

                                <template v-if="item.type == 'date'">
                                    <Datepicker :calendar-button-icon="'fa-solid fa-calendar-days'"></Datepicker>
                                </template>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 text-end">
                            <input type="button" name="pdfReport" id="pdfReport" value="Download PDF" class="btn btn-success btn-sm" @click="generateReport('pdf')"/>
                            <input type="button" name="excelReport" id="excelReport" value="Download Excel" class="btn btn-warning btn-sm" @click="generateReport('excel')"/>                            
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </main>
</template>
<script src="@/views/modules/MisReports/js/ReportSel.js"></script>

