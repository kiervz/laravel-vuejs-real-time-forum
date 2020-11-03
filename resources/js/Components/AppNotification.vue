<template>
    <div class="text-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn icon v-bind="attrs" v-on="on">
                    <v-icon color="blue">
                        notifications
                    </v-icon> {{ unreadCount }}
                </v-btn>
            </template>
            <v-list width="320">
                <div v-for="item in unread" :key="item.id" dense>
                    <v-list-item>
                        <v-list-item-content>
                            <router-link 
                                :to="item.path" 
                                class="text-decoration-none text-truncate">
                                <v-list-item-subtitle 
                                    class="blue--text" 
                                    @click="readIt(item)">
                                    {{ item.replyBy + ' commented on your post: ' + item.reply }}
                                </v-list-item-subtitle>
                                <div class="caption">November 1 at 4:32pm</div>
                            </router-link>
                        </v-list-item-content>
                    </v-list-item>
                    <v-divider></v-divider>
                </div>
                
                <div v-for="item in read" :key="item.id" dense>
                    <v-list-item>
                        <v-list-item-content>
                            <router-link 
                                :to="item.path" 
                                class="text-decoration-none text-truncate">
                                <v-list-item-subtitle>
                                    {{ item.replyBy + ' commented on your post: ' + item.reply }}
                                </v-list-item-subtitle>
                                <div class="caption grey--text">{{ item.created_at }}</div>
                            </router-link>
                        </v-list-item-content>
                    </v-list-item>
                    <v-divider></v-divider>
                </div>
                <v-list-item-content v-if="read == '' && unread == ''">
                    <div class="text-center">No Notification.</div>
                </v-list-item-content>
            </v-list>
        </v-menu>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                read : {},
                unread : {},
                unreadCount : 0,
            }
        },
        created() {
            if (User.loggedIn()) {
                this.getNotifications()
            }
        },
        methods: {
            getNotifications() {
                axios.post('/api/notifications')
                    .then(({data}) => {
                        this.read = data.read
                        this.unread = data.unread
                        this.unreadCount = data.unread.length
                    })
                    .catch(error => console.log(error.response.data))
            },
            readIt(notification) {
                axios.post('/api/markAsRead',{id:notification.id})
                    .then(res => {
                        this.unread.splice(notification, 1)
                        this.read.push(notification)
                        this.unreadCount--
                    })
                    .catch()
            }
        }
    }
</script>