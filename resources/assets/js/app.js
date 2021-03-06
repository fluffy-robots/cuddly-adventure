
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */


Vue.component('example', require('./components/Example.vue'));
Vue.component('media-browser', require('./components/MediaBrowser.vue'));
Vue.component('ui-elements', require('./components/UI-Elements.vue'));
Vue.component('editor', require('./components/Editor.vue'));
Vue.component('product-types', require('./components/ProductTypes.vue'));
Vue.component('field-types', require('./components/FieldTypes.vue'));
Vue.component('products', require('./components/Products.vue'));
Vue.component('product-fields', require('./components/ProductFields.vue'));

const app = new Vue({
    el: 'body'
});
