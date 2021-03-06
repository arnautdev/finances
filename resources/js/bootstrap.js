window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

try {

    window.Popper = require('admin-lte/plugins/popper/popper');
    window.$ = window.jQuery = require('jquery/dist/jquery')
    require('admin-lte/plugins/jquery-ui/jquery-ui.min');
    require('admin-lte/plugins/bootstrap/js/bootstrap.bundle');

    /// daterange picker
    require('admin-lte/plugins/daterangepicker/daterangepicker');

    /// datetimepicker
    window.moment = require('moment/moment');
    require('admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4');

    require('admin-lte/plugins/select2/js/select2.full');

    require('../admin-lte/js/adminlte')
    require('../admin-lte/js/customs')


    /// parsley js
    require('parsleyjs');
    require('parsleyjs/src/i18n/en');
    require('parsleyjs/src/i18n/bg');
    window.Parsley.setLocale($appLocale);

} catch (e) {
    console.warn(e);
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token.content
        }
    });
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
