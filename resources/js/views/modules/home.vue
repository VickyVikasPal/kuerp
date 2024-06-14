<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <ul class="nav_breadcrumbs">
                    <li><router-link to="/modules/home">Home</router-link></li>
                </ul>
            </div>
            <div class="col-4 text-end">

            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><img :src="ImagePath+'/assets/images/dash1.svg'" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><i class="fa-solid fa-indian-rupee-sign me-1"></i><span class="counters"
                                data-count="307144.00">307144</span></h5>
                        <h6>Total Purchase Due</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><img :src="ImagePath+'/assets/images/dash2.svg'" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><i class="fa-solid fa-indian-rupee-sign me-1"></i><span class="counters"
                                data-count="4385.00">4385</span></h5>
                        <h6>Total Sales Due</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><img :src="ImagePath+'/assets/images/dash3.svg'" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><i class="fa-solid fa-indian-rupee-sign me-1"></i><span class="counters"
                                data-count="385656.50">385656.5</span></h5>
                        <h6>Total Sale Amount</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash3">
                    <div class="dash-widgetimg">
                        <span><img :src="ImagePath+'/assets/images/dash4.svg'" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><i class="fa-solid fa-indian-rupee-sign me-1"></i><span class="counters"
                                data-count="40000.00">40000</span></h5>
                        <h6>Total Sale Amount</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count">
                    <div class="dash-counts">
                        <h4>100</h4>
                        <h5>Customers</h5>
                    </div>
                    <div class="dash-imgs">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das1">
                    <div class="dash-counts">
                        <h4>100</h4>
                        <h5>Suppliers</h5>
                    </div>
                    <div class="dash-imgs">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das2">
                    <div class="dash-counts">
                        <h4>100</h4>
                        <h5>Purchase Invoice</h5>
                    </div>
                    <div class="dash-imgs">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das3">
                    <div class="dash-counts">
                        <h4>105</h4>
                        <h5>Sales Invoice</h5>
                    </div>
                    <div class="dash-imgs">
                        <i class="fa-solid fa-file"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
                <div class="card mb-2">
                    <div class="card-header bg-white border-bottom-0 pb-0 d-flex justify-content-between align-items-center">
                        <h3>Purchase & Sales</h3>
                        <div class="graph-sets">
                            <ul>
                                <li>
                                    <span>Sales</span>
                                </li>
                                <li>
                                    <span>Purchase</span>
                                </li>
                            </ul>
                            <select class="form-select-sm">
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="sales_charts"></div>
                    </div>
                </div>
                
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="card mb-2">
                    <div class="card-header bg-white border-bottom-0 pb-0 d-flex justify-content-between align-items-center">
                        <h3>Purchase & Sales</h3>
                    </div>
                    <div class="card-body">
                        <div id="invoice_chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import loader from "@/views/shared/loading/Loading.vue";
    export default {
        name: "dashboard",
        comments:{
            loader,
        },
        data() {
            return {
                user: '',
                ImagePath:'',
            }
        },
        mounted() {
            if(window.location.host == 'billings.softdevloper.com')
                    {
                        this.ImagePath = '/public';
                    }else{
                        this.ImagePath = '';
                    }
        }
    }
</script>