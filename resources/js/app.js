import Prism from 'prismjs';
import Vue from 'vue';
import axios from 'axios';

window.Vue = Vue;
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const components = require.context('./App', true, /\.vue$/i)
components.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], components(key).default))

const app = new Vue({
    el: '#app',
});
