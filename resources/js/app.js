require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
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