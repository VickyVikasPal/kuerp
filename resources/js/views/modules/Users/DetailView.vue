<template>
    <main>
        <div class="container-fluid">
            <div class="card mb-2">
                <div class="card-header">
                    <h3 class="d-inline-block">Edit User</h3>
                    <span class="float-end">
                        <button class="btn btn-danger btn-sm" type="button"  data-bs-toggle="modal" data-bs-target="#deleteModal">
                            Delete user
                        </button>
                    </span>
                </div>
                <form @submit.prevent="saveUser" method="post" enctype="multipart/form-data" id="form-user-group" class="form-horizontal">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                  <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" v-model="user.first_name" id="first_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                  <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" v-model="user.last_name" id="last_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                 <div class="form-group">
                                    <label for="username">User Name</label>
                                    <input type="text" v-model="user.username" id="username" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" v-model="user.email" id="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="designation_id">Designation</label>
                                    <input type="text" v-model="user.designation_id" id="designation_id"  class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                 <div class="form-group">
                                    <label for="department_id">Department</label>
                                    <input type="text" v-model="user.department_id" id="department_id" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" v-model="user.phone" id="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" v-model="user.status" class="form-select">
                                        <option :value="1">Enabled</option>
                                        <option :value="0">Disabled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="time_format">Time Format</label>
                                    <select id="time_format" v-model="user.time_format" class="form-select">
                                        <option :value="1">12-hrs</option>
                                        <option :value="0">24-hrs</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="time_zone">Time Zone</label>
                                    <input type="text" v-model="user.time_zone" id="time_zone" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                 <div class="form-group">
                                    <label for="role_id">User Role</label>
                                    <select id="role_id" v-model="user.role_id" class="form-select" required>
                                        <option :value="null" disabled>Select an option</option>
                                        <option v-for="userRole in userRoles" :value="userRole.id">{{ userRole.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary btn-sm" type="submit">
                            Update User
                        </button>
                    </div>

                 </form>
            </div>
        </div>

       

        <!-- The Modal -->
           <div class="modal" id="deleteModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Delete User</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                         <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 id="modal-headline" class="text-lg leading-6 font-medium text-gray-900">
                                {{ $t('Delete user') }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm leading-5 text-gray-500">
                                    {{ $t('Are you sure you want to delete the user?') }}
                                    {{ $t('This action cannot be undone') }}.
                                </p>
                            </div>
                        </div>
                       
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-sm" type="button" @click="deleteUser">
                            {{ $t('Delete user') }}
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"> {{ $t('Cancel') }}</button>
                    </div>

                    </div>
                </div>
            </div>

    </main>
</template>
<script src="@/views/modules/Users/js/DetailView.js"></script>