<template>
    <main>
        <breadcrumbs></breadcrumbs>
        <div class="container-fluid">

            <form @submit.prevent="saveLocalSetting" enctype="multipart/form-data">
                <vue-element-loading :active="loading" />
                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{lang.LBL_USER_INTERFACE}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_DEFALUT_DATE_FORMAT}}</label>
                                    <select class="form-select" id="default_date_format" >
                                        <option value="key">Option 1</option>
                                        <option value="key">Option 1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_DEFALUT_TIME_FORMAT}}</label>
                                    <select class="form-select" id="default_time_format">
                                        <option  value="key">Option 1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_DEFALUT_LANGUAGE}}</label>
                                    <select class="form-select" id="default_language" >
                                        <option value="key"> Option 1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_DEFALUT_NAME_FORMAT}}</label>
                                    <input type="text" class="form-control" id="default_locale_name_format">
                                    ( "s" Salutation ,"f" First Name ,"l" Last Name )
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_SAMPLE_EXAMPLE}}</label>
                                    <input type="text" class="form-control" value="Mr. Jons Deo" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{lang.LBL_DEFAULT_CURRENCY}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_CURRENCY}}</label>
                                    <input type="text" class="form-control" name=""  id="default_currency_name" v-model="local.default_currency_name">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_CURRENCY_SYMBOL}}</label>
                                    <input type="text" class="form-control" name=""  id="default_currency_symbol" v-model="local.default_currency_symbol">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_ISO_CURRENCY_CODE}}</label>
                                    <input type="text" class="form-control" name=""  id="default_currency_iso4217" v-model="local.default_currency_iso4217">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_SEPERATOR}}</label>
                                    <input type="text" class="form-control" name=""  id="default_number_grouping_seperator" v-model="local.default_number_grouping_seperator">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_DECIMAL_SYMBOL}}</label>
                                    <input type="text" class="form-control" name=""  id="default_decimal_seperator" v-model="local.default_decimal_seperator">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{lang.LBL_EXPORT_SETTINGS}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_EXPORT_DELIMITER}}</label>
                                    <input type="text" class="form-control" name=""  id="export_delimiter" >
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_EXPORT_CHARACTOR}}</label>
                                    <select class="form-select" id="default_export_charset">
                                        <option >{{value}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-check">
                                    <input type="checkbox" name="option1"  id="disable_export"  class="form-check-input">
                                    <label class="form-check-label" for="check1">{{lang.LBL_DESABLE_EXPORT}}</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="option1"  id="admin_export_only" class="form-check-input">
                                    <label class="form-check-label" for="check2">{{lang.LBL_ADMIN_EXPORT_ONLY}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-body p-2 text-end">
                        <button btntype="Submit" class="btn btn-success btn-sm"> Save </button>
                        <router-link class="btn btn-warning btn-sm" to="/modules/administration">Cancel</router-link>
                    </div>
                </div>
            </form>
        </div>
    </main>
</template>
<script src="@/views/modules/Administration/js/LocalSettings.js"></script>