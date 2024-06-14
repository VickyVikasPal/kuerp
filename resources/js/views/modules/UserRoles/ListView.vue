<template>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 text-end">
                    <button class="btn btn-primary mr-2 btn-sm" type="button" @click="exportData">
                        {{ $t('Export') }}
                    </button>
                </div>
            </div>
            
           
            <div class="card mb-2">
                <div class="card-header">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Search</label>
                                <input id="search" v-model.lazy="search" :placeholder="$t('Search')" class="form-control" @change="getUserRoles">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                               <label>Sorting</label>
                               <select id="sort" v-model="sort.column" aria-label="Sort by"  class="form-select" @change="changeSort">
                                    <option value="name">{{ $t('Name') }}</option>
                                    <option value="type">{{ $t('Type') }}</option>
                                    <option value="created_at">{{ $t('Created at') }}</option>
                                </select>
                            </div>
                        </div>
                         <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <button class="relative " type="button" @click="changeSort">
                                <i class="fa-solid fa-sort" v-show="sort.order === 'asc'"></i>
                                <i class="fa-duotone fa-sort" v-show="sort.order === 'desc'"></i>
                                <span class="ml-2">{{ $t('Sort') }}</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <vue-element-loading :active="loading" />
                            <template v-if="userRoleList.length > 0">
        
                                <table class="table table-bordered table-striped m-0 item_table"> 
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox"/></th>
                                            <th>Name</th>
                                            <th>Assign User</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <template v-for="(userRole, index) in userRoleList">
                                            <tr>
                                                <template v-if="userRole.type === 1">
                                                    <td><input type="checkbox" v-model="records.ids" :value="userRole.id"></td>
                                                    <td>{{userRole.name}}</td>
                                                    <td>{{userRole.users }}</td>
                                                </template>
                                                <template v-else>
                                                    <td><input type="checkbox" v-model="records.ids" :value="userRole.id"></td>
                                                    <td><router-link :to="'/modules/user-roles/' + userRole.id + '/edit'"
                                                        class="d-block">{{ userRole.name }}</router-link></td>
                                                    <td>{{userRole.users }}</td>
                                                </template>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </template>
                            <template v-else-if="!loading">
                                <template v-if="search">
                                    <div class="h-full flex">
                                        <div class="m-auto">
                                            <div class="h-full w-full text-center items-center p-6">
                                                <svg-vue class="h-full md:h-64 mb-6" icon="placeholders-list"></svg-vue>
                                                <div class="w-full font-semibold text-2xl">{{ $t('No records found') }}</div>
                                                <div>{{ $t('Try changing the filters, or rephrasing your search') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <template v-else>
                                    <div class="h-full flex">
                                        <div class="m-auto">
                                            <div class="h-full w-full text-center items-center p-6">
                                                <svg-vue class="h-full md:h-64 mb-6" icon="browsing"></svg-vue>
                                                <div class="w-full font-semibold text-2xl">{{ $t('No records found') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </template>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                        
                    <p> {{ $t('Showing') }}  <span class="font-medium">{{ userRoleList.length }}</span>
                        {{ $t('user roles') }}
                    </p>
                </div>
            </div>

        </div>
     
    </main>
</template>

<script src="@/views/modules/UserRoles/js/ListView.js"></script>