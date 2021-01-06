require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

import routes from './Admin/routes';

Vue.use(VueRouter);
Vue.component('admin', require('./Admin/Admin.vue').default);

const router = new VueRouter({
    mode: 'history',
    base: '/admin',
    routes,
});

new Vue({
    el: '#app',
    router,
});
