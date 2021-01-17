require('./bootstrap');

import Vue from 'vue';
import vueDebounce from 'vue-debounce';

Vue.use(vueDebounce);

const components = require.context('./App', true, /\.vue$/i)
components.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], components(key).default))

new Vue({
    el: '#app',
});
