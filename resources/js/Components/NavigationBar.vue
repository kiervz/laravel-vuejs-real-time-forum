<template>
        <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top mb-4">
            <div class="container-fluid">
                <a href="#" class="navbar-brand"><img v-bind:src="'/images/logo.png'"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item" v-for="item in items" :key="item.title">
                            <router-link
                                :to="item.to" 
                                v-if="item.show"
                                class="nav-link">
                                {{ item.title }}
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
</template>

<script>
    export default {
        name: "NavigationBar",
        data() {
            return {
                items: [
                    { title: 'Forum', to: '/forum', show: true },
                    { title: 'Ask Question', to: '/ask', show: User.loggedIn() },
                    { title: 'Category', to: '/category', show: User.loggedIn() },
                    { title: 'Login', to: '/login', show: !User.loggedIn() },
                    { title: 'Logout', to: '/logout', show: User.loggedIn() },
                ]
            }
        },
        created() {
            EventBus.$on('logout', () => {
                User.logOut();
            })
        }
    }
</script>