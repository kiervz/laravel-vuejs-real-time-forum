window.Vue = require('vue');

import VueRouter from 'vue-router';

Vue.use(VueRouter);


const routes = [
    { path: '/login', name: 'login', component: require('../components/auth/Login.vue').default },
    { path: '/signup', name: 'signup', component: require('../components/auth/Signup.vue').default },,
    { path: '/', name: 'forum', component: require('../components/Forum/Forum.vue').default },,
    { path: '/question/:id/:slug', name: 'read', component: require('../components/Forum/Read.vue').default },
    { path: '/ask', name: 'ask', component: require('../components/Forum/CreateQuestion.vue').default },
    { path: '/logout', name: 'logout', component: require('../components/auth/Logout.vue').default },
]


const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});

export default router
