
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('Attachments', require('./components/Attachments.vue'));
Vue.component('Edit_attachments', require('./components/Edit_attachments.vue'));
Vue.component('Edit_attachments_list', require('./components/Edit_attachments_list.vue'));
Vue.component('Studio_request', require('./components/Studio_request.vue'));

const app = new Vue({
    el: '#app'
});
