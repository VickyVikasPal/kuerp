<template>
    <main>
        <breadcrumbs></breadcrumbs>
        <div class="container-fluid">
            <div class="card mb-2">
                <div class="card-header">
                    <h3>Please select File(s) to repair</h3>
                </div>
                <div class="card-body">
                    <form @submit.prevent="quickRepair">
                        <div class="row">
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check1" v-model="clear.cache" checked>
                                    <label class="form-check-label">{{lang.LBL_CLEAR_CACHE}}</label>
                                    <label :class="dnone1">&#10004;</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check2" v-model="clear.blade" checked>
                                    <label class="form-check-label">{{lang.LBL_CLEAR_BLADE}}</label>
                                    <label :class="dnone2">&#10004;</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check3" v-model="clear.optimize" checked>
                                    <label class="form-check-label">{{lang.LBL_CLEAR_CLASSES}}</label>
                                    <label :class="dnone3">&#10004;</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check3" v-model="clear.optimize" checked>
                                    <label class="form-check-label">{{lang.LBL_CLEAR_ROUTE}}</label>
                                    <label :class="dnone4">&#10004;</label>
                                </div>
                                
                            </div>
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <button type="submit" class="btn btn-success btn-sm">Repair</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</template>

<script src="@/views/modules/Administration/js/Repair.js"></script>
