require('alpinejs');
import Prism from 'prismjs';
import Vue from 'vue';
import axios from 'axios';

window.Vue = Vue;
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.component('site-nav', require('./Components/SiteNav').default);
Vue.component('newsletter-subscribe', require('./Components/NewsletterSubscribe').default);

const app = new Vue({
    el: '#app',
});
