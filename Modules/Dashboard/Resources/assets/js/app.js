// require core theme settings
require(__dirname + '/bootstrap');
require(__dirname + '/theme/default');
require(__dirname + '/theme/core.theme');

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');

Vue.component('notifications', require('./components/HeaderNotifications.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#page-container',
    created: function () {
        console.log('Vue.js');
    },
    methods: {
        // translate strings
        trans(str) {
            return str;
        }
    }
});
