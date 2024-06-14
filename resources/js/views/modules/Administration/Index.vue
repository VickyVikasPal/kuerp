<template>
    <main>

        <breadcrumbs></breadcrumbs>

        <div class="container-fluid">

            <div class="card index-card mb-2">
                <div class="card-header p-2">
                    <h3>{{lang.LBL_SYSTEM_CONFIGRATION}}</h3>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/administration/systemsettings" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_SYSTEM_SETTINGS}}
                            </router-link>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/administration/pdfconfig" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_PDF_SETTINGS}}
                            </router-link>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/schedulers" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_DEFAULT_SCHEDULER}}
                            </router-link>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/administration/localsettings" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_LOCAL_SETTINGS}}
                            </router-link>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/administration/repair" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_RPAIR_REBUILD}}
                            </router-link>
                        </div>
                      
                         <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/administration/unique" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_UNIQUE_IDENTIFIERS}}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card index-card mb-2">
                <div class="card-header p-2">
                    <h3>{{lang.LBL_GLOBAL_SETTINGS}}</h3>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/administration/approvalsetting" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_APPROVAL_SETTINGS}}
                            </router-link>
                        </div>
                       
                         <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/administration/globalsetting" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_GLOBAL_SETTINGS}}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card index-card mb-2">
                <div class="card-header p-2">
                    <h3>{{lang.LBL_DEFAULT_USER}}</h3>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/users" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_USER_MANAGEMENT}}
                            </router-link>
                        </div>
                     
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/users/loginusers" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_USER_LOGGED_IN}}
                            </router-link>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/userdashlets" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_USER_DASHLETS}}
                            </router-link>
                        </div>
                       
                    </div>
                </div>
            </div>

            <div class="card index-card mb-2">
                <div class="card-header p-2">
                    <h3>{{lang.LBL_DEFAULT_EMAIL}}</h3>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/emails/edit" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_EMAIL_SETTINGS}}
                            </router-link>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/emails" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_VIEW_EMAIL}}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card index-card mb-2">
                <div class="card-header p-2">
                    <h3>{{lang.LBL_USER_REPORTS}}</h3>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/userreports/edit" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_NEW_USER_REPORT}}
                            </router-link>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/userreports" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_VIEW_USER_REPORT}}
                            </router-link>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/userreports/pdfrequest" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_PDF_REQUESTS}}
                            </router-link>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/reportauths" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_REPORT_AUTHORIZATION}}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card index-card mb-2">
                <div class="card-header p-2">
                    <h3>{{lang.LBL_PRINTER_SETTINGS}}</h3>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/formatsetting/addprint" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_NEW_PRINT_SIZE}}
                            </router-link>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/formatsetting/viewprint" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_AVAILABLE_PRINT_SIZE}}
                            </router-link>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/formatsetting/addcurrentsetting" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_CURRENT_PRINT_SIZE}}
                            </router-link>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link to="/modules/formatsetting/viewcurrentsetting" class="d-inline-block">
                                <i class="fa-solid fa-gear"></i>{{lang.LBL_VIEW_CURRENT_PRINT_SIZE}}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>

       

            

        </div>

    </main>
</template>
<script src="@/views/modules/Administration/js/Index.js"></script>
