<template>

    <div class="container-fluid">
        <form @submit.prevent="saveUserRole" method="post" enctype="multipart/form-data" id="form-user-group"
            class="form-horizontal">
            <div class="card mb-2">
                <div class="card-header card-icon">
                    <h3><i class="fa-solid fa-angles-right"></i>{{lang.LBL_ADD_USER_GROUP}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{lang.LBL_USER_GROUP_NAME}}</label>
                                <input type="text" id="name" v-model="userRole.name" class="form-control">
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="status">{{lang.LBL_STATUS}}<span class="required">*</span></label>
                                <select class="form-select" id="status" v-model="userRole.status">
                                    <option value="">Select</option>
                                    <option v-for="(value, key) in dom_array.status" :value="key" :key="key">{{value}}</option>
                                </select>
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
                    <div class="table_responsive">
                        <table cellspacing="0" cellpadding="0" class="table m-0 item_table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Access</th>
                                    <th>Delete</th>
                                    <th>Export</th>
                                    <th>List</th>
                                    <th>Edit</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, rowIndex) in modules" :key="rowIndex">
                                    <td><b>{{ row }}</b></td>
                                    <td v-for="(option, colIndex) in availableOptions" v-if="availableOptions && availableOptions.length" :key="colIndex">
                                        <select v-model="action_data[rowIndex].access">
                                            <template v-for="item in option.access">
                                                <option :value="item">{{item}}</option>
                                            </template>
                                        </select>
                                    </td>
                                    <td v-for="(option, colIndex) in availableOptions" v-if="availableOptions && availableOptions.length" :key="colIndex">
                                        <select v-model="action_data[rowIndex].delete">
                                            <template v-for="item in option.delete">
                                                <option :value="item">{{item}}</option>
                                            </template>
                                        </select>
                                    </td>
                                    <td v-for="(option, colIndex) in availableOptions" v-if="availableOptions && availableOptions.length" :key="colIndex">
                                        <select v-model="action_data[rowIndex].export">
                                            <template v-for="item in option.export">
                                                <option :value="item">{{item}}</option>
                                            </template>
                                        </select>
                                    </td>
                                    <td v-for="(option, colIndex) in availableOptions" v-if="availableOptions && availableOptions.length" :key="colIndex">
                                        <select v-model="action_data[rowIndex].list">
                                            <template v-for="item in option.list">
                                                <option :value="item">{{item}}</option>
                                            </template>
                                        </select>
                                    </td>
                                    <td v-for="(option, colIndex) in availableOptions" v-if="availableOptions && availableOptions.length" :key="colIndex">
                                        <select v-model="action_data[rowIndex].edit">
                                            <template v-for="item in option.edit">
                                                <option :value="item">{{item}}</option>
                                            </template>
                                        </select>
                                    </td>
                                    <td v-for="(option, colIndex) in availableOptions" v-if="availableOptions && availableOptions.length" :key="colIndex">
                                        <select v-model="action_data[rowIndex].view">
                                            <template v-for="item in option.view">
                                                <option :value="item">{{item}}</option>
                                            </template>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body text-end">
                    <template v-if="loading">
                        <div class="card mb-2">
                           <div class="card-body">
                              <loader />
                           </div>
                        </div>
                     </template>
                    <button class="btn btn-success btn-sm" type="submit">Save</button>
                    <router-link to="/modules/user-roles" class="btn btn-warning btn-sm">Cancel</router-link>
                </div>
            </div>

        </form>

    </div>

</template>

<script src="@/views/modules/UserRoles/js/EditView.js"></script>