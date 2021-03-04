'use strict';

require(__dirname + '/bootstrap');


// theme js
window.Vue = require('vue');

Vue.component('notifications', require(__dirname + '/components/HeaderNotifications.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#dashboard-container',
    created: function () {
        console.log('Vue.js');
    },
    methods: {
        trans(str) {
            return str;
        }
    }
});
