<template>
    <main>
        <breadcrumbs></breadcrumbs>
        <div class="container-fluid">
            <!--- static links !-->
            <div class="card index-card mb-2">
                <div class="card-header">
                    <h3><i class="fa-solid fa-angles-right"></i>&nbsp;{{lang.LBL_INVENTORY}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                            <router-link :to="'/modules/bulkinventorys'" class="d-inline-block">
                                <i class="fa-solid fa-file"></i>{{lang.LBL_ADD_BULK_INVENTORY}}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <!--- static links close !-->

            <div class="card index-card mb-2" v-for="(headgroup, index) in misarray.mis_array" :key="index">
                <div class="card-header">
                    <h3><i class="fa-solid fa-angles-right"></i>&nbsp;{{headgroup.group_name}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12" v-for="itemlist in headgroup.report_list">
                            <router-link :to="itemlist.url_link+'?rname='+itemlist.rname" class="d-inline-block">
                                <i class="fa-solid fa-file"></i>{{itemlist.name}}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script src="@/views/modules/MisReports/js/Index.js"></script>