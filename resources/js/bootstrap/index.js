import '@babel/polyfill';

window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Laravel = {
    ApiToken: document.head.querySelector('meta[name="api-token"]').content,
    AppRoot: document.head.querySelector('meta[name="app-route"]').content.replace(/.*\/\/[^\/]*/, ''),
    AppDebug: document.head.querySelector('meta[name="app-route"]').content ? true : false
};

if ( window.Laravel.ApiToken ) {
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + window.Laravel.ApiToken;
}

// Get the root where the app is installed, in case it's in a subdirectory.
// window.axios.defaults.baseURL = window.Laravel.AppRoot;