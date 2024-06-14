<template>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <breadcrumbs></breadcrumbs>
                </div>
            </div>

            <form @submit.prevent="saveUserRole" method="post" enctype="multipart/form-data" id="form-user-group" class="form-horizontal">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="form-group required">
                                    <label for="name">{{lang.LBL_USER_GROUP_NAME}}</label>
                                    <input type="text" v-model="userRole.name" id="name" class="form-control">
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header card-icon">
                        <h3><i class="fa-solid fa-angles-right"></i>{{lang.LBL_ACCESS_PERMISSION}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12" v-for="module in modules">
                                <div class="form-check">
                                    <input type="checkbox" v-model="userRole.permissions.accessAccess" class="form-check-input" :value="module"> 
                                    <label class="form-check-label"> {{ module }}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="javascript:void(0);" onclick="$(this).parent().find(':checkbox').prop('checked', true);" class="d-inline-block">Select All</a> / 
                                <a href="javascript:void(0);" onclick="$(this).parent().find(':checkbox').prop('checked', false);" class="d-inline-block">Unselect All</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header card-icon">
                        <h3><i class="fa-solid fa-angles-right"></i>{{lang.LBL_LIST_PERMISSION}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12" v-for="module in modules">
                                <div class="form-check">
                                    <input type="checkbox" v-model="userRole.permissions.accessList" class="form-check-input" :value="module"> 
                                    <label class="form-check-label"> {{ module }}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="javascript:void(0);" onclick="$(this).parent().find(':checkbox').prop('checked', true);" class="d-inline-block">Select All</a> / 
                                <a href="javascript:void(0);" onclick="$(this).parent().find(':checkbox').prop('checked', false);" class="d-inline-block">Unselect All</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header card-icon">
                        <h3><i class="fa-solid fa-angles-right"></i>{{lang.LBL_VIEW_PERMISSION}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12" v-for="module in modules">
                                <div class="form-check">
                                    <input type="checkbox" v-model="userRole.permissions.accessView" class="form-check-input" :value="module"> 
                                    <label class="form-check-label">{{ module }}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="javascript:void(0);" onclick="$(this).parent().find(':checkbox').prop('checked', true);" class="d-inline-block">Select All</a> / 
                                <a href="javascript:void(0);" onclick="$(this).parent().find(':checkbox').prop('checked', false);" class="d-inline-block">Unselect All</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header card-icon">
                        <h3> <i class="fa-solid fa-angles-right"></i>{{lang.LBL_ADD_PERMISSION}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12" v-for="module in modules">
                                <div class="form-check">
                                    <input type="checkbox" v-model="userRole.permissions.accessAdd" class="form-check-input" :value="module"> 
                                    <label class="form-check-label">{{ module }}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="javascript:void(0);" onclick="$(this).parent().find(':checkbox').prop('checked', true);" class="d-inline-block">Select All</a> / 
                                <a href="javascript:void(0);" onclick="$(this).parent().find(':checkbox').prop('checked', false);" class="d-inline-block">Unselect All</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header card-icon">
                        <h3><i class="fa-solid fa-angles-right"></i>{{lang.LBL_EDIT_PERMISSION}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12" v-for="module in modules">
                                <div class="form-check">
                                    <input type="checkbox" v-model="userRole.permissions.accessEdit" class="form-check-input" :value="module"> 
                                    <label class="form-check-label"> {{ module }}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="javascript:void(0);" onclick="$(this).parent().find(':checkbox').prop('checked', true);" class="d-inline-block">Select All</a> / 
                                <a href="javascript:void(0);" onclick="$(this).parent().find(':checkbox').prop('checked', false);" class="d-inline-block">Unselect All</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header card-icon">
                        <h3><i class="fa-solid fa-angles-right"></i>{{lang.LBL_DELETE_PERMISSION}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12" v-for="module in modules">
                                <div class="form-check">
                                    <input type="checkbox" v-model="userRole.permissions.accessDelete" class="form-check-input" :value="module"> 
                                    <label class="form-check-label"> {{ module }}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="javascript:void(0);" onclick="$(this).parent().find(':checkbox').prop('checked', true);" class="d-inline-block">Select All</a> / 
                                <a href="javascript:void(0);" onclick="$(this).parent().find(':checkbox').prop('checked', false);" class="d-inline-block">Unselect All</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header card-icon">
                        <h3><i class="fa-solid fa-angles-right"></i>{{lang.LBL_EXPORT_PERMISSION}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12" v-for="module in modules">
                                <div class="form-check">
                                    <input type="checkbox" v-model="userRole.permissions.accessExport" class="form-check-input" :value="module"> 
                                    <label class="form-check-label"> {{ module }}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="javascript:void(0);" onclick="$(this).parent().find(':checkbox').prop('checked', true);" class="d-inline-block">Select All</a> / 
                                <a href="javascript:void(0);" onclick="$(this).parent().find(':checkbox').prop('checked', false);" class="d-inline-block">Unselect All</a>
                            </div>
                        </div>
                    </div>
                </div>
               
                 <div class="card">
                     <div class="card-body text-end">
                        <button class="btn btn-success btn-sm" type="submit"> Create user role </button>
                        <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            Delete user role
                        </button>
                     </div>
                    
                </div>
            </form>
            
        </div>



        <!-- The Modal -->
        <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="mt-3 text-center">
                    <h3 id="modal-headline"> {{ $t('Delete user role') }} </h3>
                    <div class="mt-2">
                        <p> {{ $t('Are you sure you want to delete the user role?') }}</p>
                        <p> {{ $t('All users with this role will be moved to the default role') }}.</p>
                        <p> {{ $t('This action cannot be undone') }}. </p>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                 <button  class="btn btn-primary btn-sm"  type="button"   @click="deleteUserRole">
                    {{ $t('Delete user role') }}
                </button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
            </div>

            </div>
        </div>
        </div>

    </main>
     
    
</template>
<script src="@/views/modules/UserRoles/js/DetailView.js"></script>