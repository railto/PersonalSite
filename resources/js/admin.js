require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';

import appStore from './Admin/Store/app';

import Dashboard from "./Admin/Views/Dashboard";
import ArticleList from "./Admin/Views/Blog/ArticleList";
import AddArticle from "./Admin/Views/Blog/AddArticle";

Vue.use(VueRouter);
Vue.use(Vuex);

Vue.component('admin', require('./Admin/Admin.vue').default);

const router = new VueRouter({
    mode: 'history',
    base: '/admin',
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard,
        },
        {
            path: '/articles',
            name: 'articleList',
            component: ArticleList,
        },
        {
            path: '/articles/new',
            name: 'addArticle',
            component: AddArticle,
        },
    ],
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
