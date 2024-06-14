<template>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <breadcrumbs></breadcrumbs>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="card mb-2">
                <div class="card-header">
                    <h3>All Login Users </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped m-0 item_table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>User</th>
                                    <th>Department</th>
                                    <th>User Type</th>
                                    <th>Status</th>
                                    <th>System Address</th>
                                    <th>Last Login</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(loggedIn, index) in userList" :key="index">
                                    <td>{{index+1}}</td> 
                                    <td><a href="javascript:void(0);">{{loggedIn.user_name}}</a></td>
                                    <td>{{loggedIn.session_id}}</td><!-- department / branch name !-->
                                    <td></td><!-- user-type !-->
                                    <td><font color="green">Currently Logged In</font></td>
                                    <td>{{loggedIn.remote_address}}</td>
                                    <td>{{loggedIn.last_login}}</td>
                                    <td><button type="button" class="btn btn-primary btn-sm">Logout</button></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="d-flex justify-content-end align-items-center">
                                    <button :class="pagination.currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : ''"
                                        :disabled="pagination.currentPage <= 1"
                                        class="pagination-link btn btn-secondary btn-sm" type="button"
                                        @click="changePage(pagination.currentPage - 1)">
                                        <i class="fa-solid fa-angle-left"></i>
                                    </button>
                                    <span class="mx-2">
                                        <span>{{ (pagination.perPage * pagination.currentPage) - pagination.perPage + 1
                                            }}</span>
                                       to
                                        <span>{{ pagination.perPage * pagination.currentPage <= pagination.total ?
                                                pagination.perPage * pagination.currentPage : pagination.total }}</span>
                                               of
                                                <span>{{ pagination.total }}</span>
                                        </span>
                                        <button
                                            :class="pagination.currentPage >= pagination.totalPages ? 'opacity-50 cursor-not-allowed' : ''"
                                            :disabled="pagination.currentPage >= pagination.totalPages"
                                            class="ml-3 pagination-link btn btn-secondary btn-sm" type="button"
                                            @click="changePage(pagination.currentPage + 1)">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header">
                    <h3>Last 10 User</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped m-0 item_table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>User</th>
                                    <th>Department</th>
                                    <th>User Type</th>
                                    <th>Status</th>
                                    <th>System Address</th>
                                    <th>Last Login</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(loggedIn, index) in userList1" :key="index">
                                    <td>{{index+1}}</td> 
                                    <td><a href="javascript:void(0);">{{loggedIn.user_name}}</a></td>
                                    <td>{{loggedIn.session_id}}</td><!-- department / branch name !-->
                                    <td></td><!-- user-type !-->
                                    <td><font color="red">Logged Out User</font></td>
                                    <td>{{loggedIn.remote_address}}</td>
                                    <td>{{loggedIn.last_login}}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
           
        </div>
    </main>
</template>
<script src="@/views/modules/Users/js/LoginUsers.js"></script>
