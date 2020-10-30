require('./bootstrap');

import Vue from 'vue';
import store from './store';
import router from './routes'

import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);

//filter
import {filters} from './filter';

Vue.component('admin-main', () => import("./components/admin/AdminMaster.vue"));

Vue.component('home-main', ()=> import("./components/frontend/HomeMaster.vue"));

// const router = new VueRouter({
//     routes,
//     mode: 'history',
//     linkActiveClass: 'active',
//     linkExactActiveClass: 'active'
// });


const app = new Vue({
    el: '#app',
    router,
    store
});
