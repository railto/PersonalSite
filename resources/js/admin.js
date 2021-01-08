require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';

import routes from './Admin/routes';
import appStore from './Admin/Store/app';

Vue.use(VueRouter);
Vue.use(Vuex);

Vue.component('admin', require('./Admin/Admin.vue').default);

const router = new VueRouter({
    mode: 'history',
    base: '/admin',
    routes,
});

const store = new Vuex.Store({
    modules: {
        appStore,
    }
})

new Vue({
    el: '#app',
    router,
    store,
});
