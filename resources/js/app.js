/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import API from './api';
window.API = API;

Object.defineProperty(Vue.prototype, '$api', { value: API })

// import API from './api';
// Object.defineProperty(Vue.prototype, '$api', { value: API })
// Vue.prototype.$api = API;

// Now import Vue-Fuse for fuzzy search
import VueFuse from 'vue-fuse'
Vue.use(VueFuse)

import VueResizeText from 'vue-resize-text';
Vue.use(VueResizeText)

import Toasted from 'vue-toasted';
Vue.use(Toasted, {duration: 1500});

require('./bootstrap/vue-components')
require('./bootstrap/vue-icons')
require('./bootstrap/vue-mixins')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

/**
 * Opt-in to Webpack hot module replacement
 * See https://webpack.js.org/guides/hot-module-replacement/#enabling-hmr
 * if (module.hot) module.hot.accept(function(err) { console.warn(err) })
 */

if (module.hot) module.hot.accept()
