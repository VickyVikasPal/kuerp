<template>
    <main>
        <breadcrumbs/>
        <div class="container-fluid">
            <form @submit.prevent="saveGlobal">
                <div class="card mb-2">
                    <div class="card-header">
                        <h3>Global Settings</h3>
                    </div>
                    <div class="card-body">
                        <div class="row" v-for="(value, key) in global_data" v-if="showData" :key="key">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <label>{{lang[key]}}</label>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <select class="form-select form-control mb-1" v-model="status_value[key]">
                                    <option v-if="value !=''" :value="value" :selected="true">{{value}}</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <label>{{msg}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-body p-2 text-end">
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                        <button type="button" class="btn btn-warning btn-sm">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</template>
<script src="@/views/modules/Administration/js/GlobalSettings.js"></script>