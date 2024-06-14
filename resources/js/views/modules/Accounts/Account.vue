<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{ lang.LBL_PERSONAL_INFO }}</h3>
                    </div>
                    <form @submit.prevent="editUser" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="avatar-editor me-3">
                                            <!-- <img v-if="account.avatar_path" :src="account.avatar_path" alt="No Preview"
                                                class="avatar-img w-100 h-100"> -->
                                            <img src="../../../../../public/assets/images/profile-45x45.png"  alt="No Preview" class="avatar-img w-100 h-100">
                                        </div>
                                        <div class="btn btn-sm btn-file mb-0">
                                            <i class="fa-solid fa-folder"></i>
                                            <input accept=".png,.jpg,.jpeg" type="file" @change="changeFile($event)" class="form-control ">
                                            <span class="ms-2">Browse …</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="first_name">{{lang.LBL_FIRST_NAME}}<span
                                                class="required">*</span></label>
                                        <input type="text" class="form-control" id="first_name" v-model="account.first_name">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="last_name">{{lang.LBL_LAST_NAME}}<span
                                                class="required">*</span></label>
                                        <input type="text" class="form-control" id="last_name" v-model="account.last_name">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <label>{{msg}}</label>
                                </div>
                                <div class="col-6 text-end">
                                    <button class="btn btn-success btn-sm" type="submit">
                                        {{lang.LBL_SAVE}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card mb-2">
                    <div class="card-header">
                        <h3>{{ lang.LBL_CHANGE_PASSWORD }}</h3>
                    </div>
                    <form @submit.prevent="changePassword">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="form-group ">
                                        <label>{{ lang.LBL_CURRENT_PASSWORD }}</label>
                                        <input id="current_password"  placeholder="Your current password" class="form-control"  type="password">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="form-group ">
                                        <label>{{ lang.LBL_NEW_PASSWORD }}</label>
                                        <input id="password" placeholder="Your new password" class="form-control" type="password">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="form-group ">
                                        <label>{{ lang.LBL_CONFIRM_PASSWORD }}</label>
                                        <input id="password_confirmation" placeholder="Confirm your new password" class="form-control" type="password">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <label>{{msgpass}}</label>
                                </div>
                                <div class="col-6 text-end">
                                    <button class="btn btn-success btn-sm" type="submit">
                                        {{lang.LBL_CHANGE_PASSWORD}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="@/views/modules/Accounts/js/Account.js"></script>