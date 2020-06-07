require('./bootstrap');

window.Vue = require('vue');
Vue.component('mock-list-page', require('./componets/MockList.vue').default);
Vue.component('mock-details-page', require('./componets/MockDetails.vue').default);

const app = new Vue({
    el: '#app',
});