require('./bootstrap');

window.Vue = require('vue');

import User from './Helpers/User';
window.User = User;

console.log(User.loggedIn())

window.EventBus = new Vue();

Vue.component('NavigationBar', require('./components/NavigationBar.vue').default);

import router from './Router/router_.js'

const app = new Vue({
  el: '#app',
  router
});