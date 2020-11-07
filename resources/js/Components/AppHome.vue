<template>
    <v-app>
        <v-app-bar app dense dark fixed>
            <v-app-bar-nav-icon @click="drawer = !drawer" class="hidden-md-and-up"></v-app-bar-nav-icon>
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
                        <v-avatar color="primary" size="35">
                            <span class="white--text">S</span>
                        </v-avatar>
                    </v-btn>
                </template>
                <v-card>
                    <v-list>
                        <v-list-item-group>
                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-title  class="text-center">
                                        <router-link :to="this.loggedInUserPath" class="text-decoration-none black--text">
                                        <v-icon>person</v-icon>{{ loggedInUser }}</router-link>
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-content class="text-center">
                                    <v-list-item-title>
                                        <router-link to="/logout" class="text-decoration-none black--text">
                                            Logout
                                        </router-link>
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                </v-card>
            </v-menu>
        </v-app-bar>
        <v-navigation-drawer
            v-model="drawer"
            fixed
            dark
            temporary>
            <div v-for="(item, index) in items" :key="index" >
                <v-btn text block :to="item.to" v-if="item.show">{{ item.title }}</v-btn>
            </div>
        </v-navigation-drawer>
        <br><br>
        <router-view></router-view>
        <app-footer></app-footer>
    </v-app>
</template>

<script>
    import AppFooter from './AppFooter'
    import AppNotification from './AppNotification'

    export default {
        components: { AppFooter, AppNotification},
        data() {
            return {
                items: [
                    { title: 'Forum', to: '/', show: true },
                    { title: 'Ask Question', to: '/ask', show: User.loggedIn() },
                    { title: 'Category', to: '/category', show: User.admin() },
                    { title: 'Login', to: '/login', show: !User.loggedIn() },
                ],
                loggedIn: User.loggedIn(),
                loggedInUser: User.name(),
                loggedInUserPath: null,
                drawer: null,
            }
        },
        created() {
            EventBus.$on('logout', () => {
                User.logOut();
            })
            if (User.loggedIn()) {
                this.getUserPath()
            }
        },
        methods: {
            getUserPath(){
                axios.post(`/api/user/${ User.id() }`)
                    .then((res) => {
                        this.loggedInUserPath = res.data.user.user_path
                    })
                    .catch(error => console.log(error.response.data))
            }
        }
    }   
</script>

<style>
    .fixed-bar {
        position: sticky;
        position: -webkit-sticky; /* for Safari */
        top: 0em;
        z-index: 2;
    }
</style>