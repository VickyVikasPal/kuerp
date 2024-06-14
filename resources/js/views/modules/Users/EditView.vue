<template>
    <div class="container-fluid">
        <form @submit.prevent="saveUser" enctype="multipart/form-data">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row">
                     
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Profile Image </label>
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="avatar-editor me-3">
                                        <img v-if="preview_image" :src="user.avatar_preview" class="avatar-img w-100 h-100" />
                                        <img v-else-if="user.avatar_path" :src="user.avatar_path" class="avatar-img w-100 h-100" />
                                        <img v-else :src="user.avatar" class="avatar-img w-100 h-100 dd" />
                                    </div>
                                    <div class="btn btn-sm btn-file mb-2">
                                        <i class="fa-solid fa-folder"></i>
                                        <input accept=".png,.jpg,.jpeg" type="file" @change="changeFile($event)"
                                            class="form-control">
                                        <span>Browse …</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="first_name">{{lang.LBL_FIRST_NAME}}<span class="required">*</span></label>
                                <input type="text" class="form-control" id="first_name" v-model="user.first_name">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="last_name">{{lang.LBL_LAST_NAME}}<span class="required">*</span></label>
                                <input type="text" class="form-control" id="last_name" v-model="user.last_name">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="status">{{lang.LBL_USER_STATUS}}<span class="required">*</span></label>
                                <select class="form-select" id="status" v-model="user.status">
                                    <option value="">Select</option>
                                    <option v-for="(value, key) in dom_array.status" :value="key">{{value}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="login_status">{{lang.LBL_LOGIN_STATUS}}<span
                                        class="required">*</span></label>
                                <select class="form-select" id="login_status" v-model="user.login_status">
                                    <option value="">Select</option>
                                    <option v-for="(value, key) in dom_array.login_status" :value="key">{{value}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="user_type">{{lang.LBL_USER_TYPE}}</label>
                                <select class="form-select" id="user_type" v-model="user.user_type">
                                    <option value="">Select</option>
                                    <option v-for="(value, key) in dom_array.user_type" :value="key">{{value}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="user_name">{{lang.LBL_USER_NAME}}<span class="required">*</span></label>
                                <input type="text" class="form-control" id="user_name" v-model="user.user_name">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="password">{{lang.LBL_USER_PASSWORD}}</label>
                                <input type="password" class="form-control" id="password" v-model="user.password">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="password_confirmation">{{lang.LBL_CONFIRM_PASSWORD}}</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    v-model="user.password_confirmation">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header">
                    <h3>{{lang.LBL_DEFAULT_EMAIL}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="email_client">{{lang.LBL_EMAIL_CLIENT}}</label>
                                <select class="form-select" v-model="user.email_client">
                                    <option selected="" value="">System Default Mail Client</option>
                                    <option value="sugar">SugarCRM Mail Client</option>
                                    <option value="mailto">External Mail Client</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6 col-12">
                            <table class="table table-bordered table-striped m-0 item_table">
                                <thead>
                                    <tr>
                                        <th>Enter Mail</th>
                                        <th>Primary</th>
                                        <th>Reply-to</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(row, index) in rows" :key="index">
                                        <td><input type="text" v-model="user.email" id="email"></td>
                                        <td align="center"><input type="radio" v-model="user.email_primary"
                                                value="Primary"></td>
                                        <td align="center"><input type="radio" v-model="user.email_reply_to"
                                                value="Reply To"></td>
                                        <td align="center"><a href="#" @click.prevent="removeRow(index)"><i
                                                    class="fa-solid fa-trash-can"></i></a></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" align="right"><a href="javascript:void(0);" @click="addRow"><i
                                                    class="fa-solid fa-plus"></i> Add Address</a></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header">
                    <h3>{{lang.LBL_USER_INFO}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group item-select">
                                <label for="branch_name">{{lang.LBL_BRANCH}}<span class="required">*</span></label>
                                <input type="text" class="form-control" v-model="user.branch_name" id="branch_name"
                                autocomplete="off" v-on:keyup="queryForKeywords($event, 'branch','branch_id')"
                                v-on:keydown="queryForKeywords($event, 'branch','branch_id')" />
                                <input type="hidden" name="" id="branch_id" v-model="user.branch_id">
                                <span class="group-select">
                                    <span ref="genericSearch" @click="openComponent('branchs','Branchs','branch_id')"><i
                                            class="fa-solid fa-user-plus"></i></span>
                                    <span @click="clearComponent('branch')"><i class="fa-solid fa-xmark"></i></span>
                                </span>
                                <ul class="dropdown_type" v-if="showDropdown=='branch_id'">
                                    <li v-for="item in dropdownList" :key="item.id"
                                        @click="updateItem(item.id,item.name,'branch')">{{item.name}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group item-select">
                                <label for="role_name">{{lang.LBL_ROLE}}<span class="required">*</span></label>
                                <input type="text" class="form-control" v-model="user.user_role_name"
                                id="user_role_name" autocomplete="off"
                                v-on:keyup="queryForKeywords($event, 'user-role','role_id')"
                                v-on:keydown="queryForKeywords($event, 'user-role','role_id')" />
                                <input type="hidden" name="" id="role_id" v-model="user.role_id">
                                <span class="group-select">
                                    <span ref="genericSearch"
                                        @click="openComponent('user-roles','UserRoles','role_id')"><i
                                            class="fa-solid fa-user-plus"></i></span>
                                    <span @click="clearComponent('user-role')"><i class="fa-solid fa-xmark"></i></span>
                                </span>
                                <ul class="dropdown_type" v-if="showDropdown=='role_id'">
                                    <li v-for="item in dropdownList" :key="item.id"
                                        @click="updateItem(item.id,item.name,'user-role')">{{item.name}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="first_name">{{lang.LBL_USER_SEX}}</label>
                                <select class="form-select" v-model="user.sex">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="phone_mobile">{{lang.LBL_USER_MOBILE}}</label>
                                <input type="text" class="form-control" v-model="user.phone_mobile">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="qualification">{{lang.LBL_USER_QUALIFICATION}}</label>
                                <input type="text" class="form-control" v-model="user.qualification">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="specialization">{{lang.LBL_USER_SPECIFICATION}}</label>
                                <input type="text" class="form-control" v-model="user.specialization">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header">
                    <h3>{{lang.LBL_USER_ADDRESS_INFO}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="address_street">{{lang.LBL_PRIMARY_ADDRESS}}</label>
                                <textarea class="text-area" cols="10" rows="2" v-model="user.address_street"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="address_city">{{lang.LBL_ADDRESS_CITY}}</label>
                                <input type="text" class="form-control" v-model="user.address_city">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="address_state">{{lang.LBL_ADDRESS_STATE}}</label>
                                <input type="text" class="form-control" v-model="user.address_state">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="address_country">{{lang.LBL_ADDRESS_COUNTRY}}</label>
                                <select class="form-select" v-model="user.address_country">
                                    <option value="India">India</option>
                                    <option value="USA">USA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="address_postalcode">{{lang.LBL_ADDRESS_POSTAL_CODE}}</label>
                                <input type="text" class="form-control" v-model="user.address_postalcode">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header">
                    <h3>{{lang.LBL_USER_SETTING}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <label>{{lang.LBL_SYSTEM_ADMINISTRATOR}}</label>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-check">
                                <input type="checkbox" value="1" class="form-check-input" v-model="user.is_admin">
                                <label class="form-check-label"></label>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">Grants system administrator privileges
                            to this user</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <label>{{lang.LBL_SHOW_FULLNAME}}</label>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-check">
                                <input type="checkbox" value="1" class="form-check-input" v-model="user.use_real_names">
                                <label class="form-check-label"></label>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">Display a user's full name instead of
                            their login name</div>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header">
                    <h3>{{lang.LBL_LOCAL_SETTING}}</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <label>{{lang.LBL_DATE_FORMAT}}</label>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <select v-model="user.dateformat" class="form-select form-control mb-2">
                                <option value="Y-m-d">2006-12-23</option>
                                <option value="m-d-Y">12-23-2006</option>
                                <option value="d-m-Y">23-12-2006</option>
                                <option value="Y/m/d">2006/12/23</option>
                                <option value="m/d/Y">12/23/2006</option>
                                <option selected="" value="d/m/Y">23/12/2006</option>
                                <option value="Y.m.d">2006.12.23</option>
                                <option value="d.m.Y">23.12.2006</option>
                                <option value="m.d.Y">12.23.2006</option>
                            </select>
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">Set the display format for date stamps
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <label>{{lang.LBL_TIME_FORMAT}}</label>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <select v-model="user.timeformat" tabindex="4" class="form-select form-control mb-2">
                                <option value="H:i">23:00</option>
                                <option value="h:ia">11:00pm</option>
                                <option selected="" value="h:iA">11:00PM</option>
                                <option value="H.i">23.00</option>
                                <option value="h.ia">11.00pm</option>
                                <option value="h.iA">11.00PM</option>
                            </select>
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">Set the display format for time stamps
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <label>{{lang.LBL_TIME_ZONE}}</label>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <select v-model="user.timezone" class="form-select form-control mb-2">
                                <option value="Africa/Abidjan">Africa/Abidjan(GMT+0) </option>
                                <option value="Africa/Accra">Africa/Accra(GMT+0) </option>
                                <option value="Africa/Addis_Ababa">Africa/Addis Ababa(GMT+3) </option>
                                <option value="Africa/Algiers">Africa/Algiers(GMT+1) </option>
                            </select>
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">Set the current time zone</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <label>{{lang.LBL_TIME_ZONEPROMPT}}</label>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-check">
                                <input type="checkbox" v-model="user.ut" value="1" class="form-check-input">
                                <label class="form-check-label"></label>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">Check to prompt user for time zone
                            confirmation on login.</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <label>{{lang.LBL_CURRENCY}}</label>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <select v-model="user.currency" class="form-select form-control mb-2">
                                <option value="-99">India Rupees : Rs. </option>
                            </select>
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">Select the default currency</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <label>{{lang.LBL_CURRENCY_DIGIT}}</label>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <select v-model="user.default_currency_significant_digits"
                                class="form-select form-control mb-2">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2" selected="true">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <label>{{lang.LBL_EXAMPLE}}</label>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <input type="text" disabled="" class="form-control mb-2">
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <label>{{lang.LBL_SEPERATOR}}</label>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <input class="form-control mb-2" v-model="user.num_grp_sep">
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">Character used to separate thousands
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <label>{{lang.LBL_DECIMAL_SYSBOL}}</label>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <input class="form-control mb-2" v-model="user.dec_sep">
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">Character used to separate decimal
                            portion</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <label>{{lang.LBL_DISPLAY_FORMAT}}</label>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <input class="form-control mb-2" v-model="user.default_locale_name_format">
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                            Set how names will be displayed.<br><i>"s" Salutation<br>"f" First Name<br>"l" Last Name</i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <label>{{lang.LBL_EXAMPLE}}</label>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <input class="form-control mb-2" name="no_value" value="Mr. John Doe" disabled="">
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12"></div>
                    </div>
                </div>
            </div>
            <vue-element-loading :active="loading" />
            <div class="card mb-2">
                <div class="card-body text-end">
                    <button btntype="Submit" class="btn btn-success btn-sm">
                        Save
                    </button>
                    <router-link class="btn btn-warning btn-sm" to="/modules/users">
                       Cancel
                    </router-link>
                </div>
            </div>
        </form>
    </div>

</template>
<script src="@/views/modules/Users/js/EditView.js"></script>