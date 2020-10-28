<template>
    <v-toolbar dense dark fixed>
        <v-app-bar-nav-icon></v-app-bar-nav-icon>
        <v-toolbar-title>Stack Underflow</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items class="hidden-sm-and-down" v-for="item in items" :key="item.title">
            <v-btn text
                :to="item.to" 
                v-if="item.show"              
            >{{ item.title }}</v-btn>
        </v-toolbar-items>
    </v-toolbar>
</template>

<script>
    export default {
        name: "NavigationBar",
        data() {
            return {
                items: [
                    { title: 'Forum', to: '/', show: true },
                    { title: 'Ask Question', to: '/ask', show: User.loggedIn() },
                    { title: 'Category', to: '/category', show: User.admin() },
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