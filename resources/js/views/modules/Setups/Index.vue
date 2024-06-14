<template>
    <main>
        <breadcrumbs/>
        <div class="container-fluid">
            <div class="card index-card mb-2" v-for="(headgroup, index) in misarray.mis_array" :key="index">
                <div class="card-header">
                    <h3><i class="fa-solid fa-angles-right"></i>&nbsp;{{headgroup.group_name}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12" v-for="itemlist in headgroup.report_list">
                            <router-link :to="itemlist.url_link" class="d-inline-block">
                                <i class="fa-solid fa-file"></i>{{itemlist.name}}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script src="@/views/modules/Setups/js/Index.js"></script>