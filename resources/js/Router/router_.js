window.Vue = require('vue');

import VueRouter from 'vue-router';

Vue.use(VueRouter);


const routes = [
    { path: '/', name: 'parallax', component: require('../components/Parallax.vue').default },
    { path: '/login', name: 'login', component: require('../components/auth/Login.vue').default },
    { path: '/signup', name: 'signup', component: require('../components/auth/Signup.vue').default },
    { path: '/forum', name: 'forum', component: require('../components/Forum/Forum.vue').default },
    { path: '/tag', name: 'tag', component: require('../components/Tag/CreateTag.vue').default },
    { path: '/question/:slug', name: 'read', component: require('../components/Forum/Read.vue').default },
    { path: '/ask', name: 'ask', component: require('../components/Forum/CreateQuestion.vue').default },
    { path: '/user/:id', name: 'user', component: require('../components/User/Profile.vue').default },
    { path: '/logout', name: 'logout', component: require('../components/auth/Logout.vue').default },
    {
        path: '*',
        name: 'NotFound',
        component: require('../components/NotFound.vue').default
    },
]


const router = new VueRouter({
    mode: 'history',
    hashbang: false,
    routes // short for `routes: routes`
});

export default router
