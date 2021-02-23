import Vue from 'vue';

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

/**
 * This is quick for development - may want to change this later to optimise.
 * We will not need to register EVERY component for EVERY page / Vue instance.
 */
const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))



Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

const app = new Vue({
    el: '#app',
});
