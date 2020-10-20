require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import User from './Helpers/User';
window.User = User;

const routes = [
    { path: '/login', component: require('./components/login/Login.vue').default },
    { path: '/hello', component: require('./components/Hello.vue').default },
    { path: '/example', component: require('./components/ExampleComponent.vue').default },
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});

const app = new Vue({
  el: '#app',
  router
});