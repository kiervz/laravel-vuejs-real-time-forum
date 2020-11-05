<template>
    <div>
        <v-toolbar dense dark fixed>
            <v-app-bar-nav-icon></v-app-bar-nav-icon>
            <v-toolbar-title>Stack Underflow</v-toolbar-title>
            <v-spacer></v-spacer>
            <app-notification v-if="loggedIn"></app-notification>
            <v-toolbar-items class="hidden-sm-and-down" v-for="item in items" :key="item.title">
                <v-btn text
                    :to="item.to" 
                    v-if="item.show"              
                >{{ item.title }}</v-btn>
            </v-toolbar-items>
            
            <v-menu bottom min-width="200px" rounded offset-y  v-if="loggedIn">
                <template v-slot:activator="{ on }">
                    <v-btn icon x-medium v-on="on">
                        <v-avatar color="brown" size="35">
                            <span class="white--text">KM</span>
                        </v-avatar>
                    </v-btn>
                </template>
                <v-card>
                    <v-list-item>
                        <v-list-item-content class="text-center">
                            <router-link to="/logout" class="text-decoration-none black--text">
                                Logout
                            </router-link>
                        </v-list-item-content>
                    </v-list-item>
                </v-card>
            </v-menu>
        </v-toolbar>

    </div>
</template>

<script>
    import AppNotification from './AppNotification'
    export default {
        name: "NavigationBar",
        components: { AppNotification },
        data() {
            return {
                items: [
                    { title: 'Forum', to: '/', show: true },
                    { title: 'Ask Question', to: '/ask', show: User.loggedIn() },
                    { title: 'Category', to: '/category', show: User.admin() },
                    { title: 'Login', to: '/login', show: !User.loggedIn() },
                ],
                loggedIn: User.loggedIn(),
            }
        },
        created() {
            EventBus.$on('logout', () => {
                User.logOut();
            })
        }
    }
</script>