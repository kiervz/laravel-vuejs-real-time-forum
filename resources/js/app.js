require('./bootstrap');

window.Vue = require('vue');

import User from './Helpers/User';
window.User = User;

console.log(User.loggedIn())

window.EventBus = new Vue();

import VueSimplemde from 'vue-simplemde'

Vue.component('vue-simplemde', VueSimplemde)

import md from 'marked'
window.md = md

Vue.component('NavigationBar', require('./components/NavigationBar.vue').default);
Vue.component('ShowQuestion', require('./components/Forum/ShowQuestion.vue').default);

import router from './Router/router_.js'

const app = new Vue({
  el: '#app',
  router
});