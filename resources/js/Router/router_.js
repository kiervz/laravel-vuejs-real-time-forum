window.Vue = require('vue');

import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
    { path: '/login', name: 'login', component: require('../components/auth/Login.vue').default },
    { path: '/signup', name: 'signup', component: require('../components/auth/Signup.vue').default },
    { path: '/forum', name: 'forum', component: require('../components/Forum.vue').default },
    { path: '/logout', name: 'logout', component: require('../components/auth/Logout.vue').default },
]


const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});

export default router
