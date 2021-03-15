try {
    window.$ = window.jQuery = require('jquery');
    window.Cookies = require('js-cookie');

    require('jqueryui');
    require('bootstrap');
    require('jquery-slimscroll');
    require('parsleyjs/src/parsley');

    require('./bootstrap');
} catch (e) {
    console.log(e);
}
