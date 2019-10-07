/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

const moment = require('moment');
Vue.use(require('vue-moment'), {
    moment
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Pages
 */
// Landing
Vue.component('landing-page', require('./pages/landing/landing-page').default);
// Quotes
Vue.component('quotes-index', require('./pages/admin/quotes/index').default);
// Users
Vue.component('users-index', require('./pages/admin/users/index').default);
/**
 * Components
 */
// Pagination
Vue.component('custom-pagination', require('./components/paginations/pagination').default);
// Modals
Vue.component('create-quote-modal', require('./components/modals/create-quote-modal').default);
Vue.component('delete-modal', require('./components/modals/delete-modal').default);
Vue.component('show-quote-modal', require('./components/modals/show-quote-modal').default);
Vue.component('update-quote-modal', require('./components/modals/update-quote-modal').default);
Vue.component('change-subscriber-status', require('./components/modals/change-subscriber-status').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
