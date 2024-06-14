/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

//import '../sass/app.scss';

// Custom css added
import '../../public/assets/css/bootstrap.min.css';
import '../../public/assets/css/fonts.css';
import '../../public/assets/css/style.css';

import '../../public/assets/js/jquery.min.js';
import '../../public/assets/js/bootstrap.bundle.min.js';
import '../../public/assets/js/fonts.js';
import '../../public/assets/js/apexcharts.min.js';
import '../../public/assets/js/apexchart-data.js';


import { createApp } from 'vue';
import Router from '@/router'
import store from '@/store'; 
import App from '@/layouts/App.vue';  


createApp(App).use(
    Router,
    store,
).mount('#app');