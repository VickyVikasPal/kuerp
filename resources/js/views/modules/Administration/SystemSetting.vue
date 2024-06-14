<template>
    <main>
        <breadcrumbs></breadcrumbs>
        <div class="container-fluid">
            <form @submit.prevent="saveSystemSetting" enctype="multipart/form-data">
                <vue-element-loading :active="loading" />
                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{lang.LBL_DEFAULT_USER_INTERFACE}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_ENTITES_LISTVIEW_ITEM}}</label>
                                    <input type="text" class="form-control" id="list_max_entries_per_page">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_MAX_NUMBER_DASHLET_HOME}}</label>
                                    <input type="text" class="form-control" id="list_max_entries_per_subpanel" >
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_SYSTEM_NAME}}</label>
                                    <input type="text" class="form-control" id="system_name">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_TOTAL_HEALTH_CHECKUP_DAY}}</label>
                                    <input type="text" class="form-control" id="healthcheckup_in_day">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="calculate_response_time"  value="1">
                                    <label class="form-check-label" for="check1">{{lang.LBL_SERVER_RESPONSE_TIMES}}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="login_nav"  value="1">
                                    <label class="form-check-label" for="check2">{{lang.LBL_TABS_LOGIN_SCREEN}}</label>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="use_real_names" value="1">
                                    <label class="form-check-label" for="check3">{{lang.LBL_SHOW_FULLNAME}}</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="lock_homepage" value="1">
                                    <label class="form-check-label" for="check4">{{lang.LBL_USER_CUSTOMIZABLE_HOMEPAGE}}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="lock_subpanels" value="1">
                                    <label class="form-check-label" for="check5">{{lang.LBL_USER_CUSTOMIZABLE_SUBPANEL}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{lang.LBL_BILL_GENERATION}}</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <label>{{lang.LBL_BILL_REQUIRED}}</label>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="registration_bill_required" value="1">
                                    <label class="form-check-label" for="check6"></label>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">This flag should be checked to
                                allow registration bill genaration</div>
                        </div>
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <label>{{lang.LBL_ENABLE_DUPLICATE_PRINT}}</label>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="show_duplicate_bill" value="1">
                                    <label class="form-check-label" for="check6"></label>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">This flag should be checked to
                                show Duplicate in print for the bills or invoice printed again</div>
                        </div>

                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{lang.LBL_DATE_CREATED_MODIFIED}}</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <label>{{lang.LBL_SHOW_CREATED_MODIFIED_SYSTEM}}</label>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="show_created_time_in_system" value="1">
                                    <label class="form-check-label" for="check8"></label>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">This flag should be checked to
                                display date created and modified in system</div>
                        </div>
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <label>{{lang.LBL_SHOW_CREATED_MODIFIED_USER}}</label>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="show_created_time_to_user" value="1">
                                    <label class="form-check-label" for="check9"></label>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">This flag (along with show date
                                created in system) should be checked to display date created and modified to users other
                                than administrator</div>
                        </div>

                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{lang.LBL_EXTERNAL_KITCHEN}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <label>{{lang.LBL_KITCHEN_MANAGED_EXTERNAL}}</label>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="external_kitchen" value="1">
                                    <label class="form-check-label" for="check10"></label>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">This flag should be checked if
                                hospital kitchen is managed by some external contractor and does not have Inhouse
                                kitchen</div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{lang.LBL_INTERNAL_PHARMACY}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <label>{{lang.LBL_USER_INTERNAL_PHARMACY}}</label>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="internal_pharmacy" value="1">
                                    <label class="form-check-label" for="check11"></label>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">This flag should be checked if
                                Hospital uses Internal Pharmacy</div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{lang.LBL_HOSPITAL_LAVEL_SYSTEM}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <label>{{lang.LBL_HOSPITAL_ENABLE_SYSTEM}}</label>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="enable_hl7" value="1">
                                    <label class="form-check-label" for="check12"></label>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">This flag should be checked to
                                Integrate HL7 in the System</div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{lang.LBL_HOSPITAL_NAME_ADDRESS}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_NAME}}</label>
                                    <input type="text" class="form-control" id="hospitalname_name">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_ADDRESS_1}}</label>
                                    <input type="text" class="form-control" id="hospitalname_address1">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_ADDRESS_2}}</label>
                                    <input type="text" class="form-control" id="hospitalname_address2">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_CITY}}</label>
                                    <input type="text" class="form-control" id="hospitalname_city">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_STATE}}</label>
                                    <input type="text" class="form-control" id="hospitalname_state" >
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_PINCODE}}</label>
                                    <input type="text" class="form-control" id="hospitalname_pin">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_COUNTRY}}</label>
                                    <input type="text" class="form-control" id="hospitalname_country">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_PHONE}}</label>
                                    <input type="text" class="form-control" id="hospitalname_phone">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_WEBSITE_URL}}</label>
                                    <input type="text" class="form-control" id="hospitalname_site">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_FACEBOOK_URL}}</label>
                                    <input type="text" class="form-control" id="socialnetworksite_facebook">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_TWITTER_URL}}</label>
                                    <input type="text" class="form-control" id="socialnetworksite_twitter">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_YOUTUBE_URL}}</label>
                                    <input type="text" class="form-control" id="socialnetworksite_youtube">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_INSTAGRAM_URL}}</label>
                                    <input type="text" class="form-control" id="socialnetworksite_instagram">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_WEBLINK}}</label>
                                    <input type="text" class="form-control" id="socialnetworksite_privateweblink">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_EMAIL}}</label>
                                    <input type="text" class="form-control" id="hospitalname_email">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_SMS_FOOTER}}</label>
                                    <input type="text" class="form-control" id="hospitalname_forsms">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_TIN_NUMBER}}</label>
                                    <input type="text" class="form-control" id="tin_no">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_GSTIN_NUMBER}}</label>
                                    <input type="text" class="form-control" id="gstin">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_PAN_NUMBER}}</label>
                                    <input type="text" class="form-control" id="pan_no">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{lang.LBL_DEFAULT_HOSPITAL_CONTACT_ADDRESS}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{lang.LBL_HOSPITAL_CONTACT_ADDRESS}}</label>
                                    <textarea rows="3" cols="10" class="textArea" id="hospital_contact_address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{lang.LBL_DEFAULT_PRINT_HEADER_FOOTER}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <label>{{lang.LBL_PRINT_HEADER_FOOTER}}</label>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="display_header_footer_in_print" value="1">
                                    <label class="form-check-label" for="check13"></label>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">This flag should be checked if
                                header & footer is required in Printing</div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body p-2 text-end">
                        <button btntype="Submit" class="btn btn-success btn-sm">Save</button>
                        <router-link class="btn btn-warning btn-sm" to="/modules/administration">Cancel</router-link>
                    </div>
                </div>

            </form>

        </div>

    </main>
</template>
<script src="@/views/modules/Administration/js/SystemSetting.js"></script>