<template>
    <v-card class="mt-2">
        <v-list-item-content>
            <v-flex md11>
                <div class="ml-4">
                    <router-link 
                        :to="data.user" 
                        class="text-decoration-none">{{ data.user }}
                    </router-link>
                    <span class="grey--text caption">{{ data.created_at }}</span>
                </div>
            </v-flex>
            <v-flex md1>
                <likes :data="data"></likes>
            </v-flex>
            <edit-reply 
                v-if="isEdit"
                :reply=data>
            </edit-reply>
            <v-card-text 
                v-else 
                class="text--primary" 
                v-html="reply">
            </v-card-text>
        </v-list-item-content>
        <div v-if="!isEdit">
            <v-card-actions v-if="own">
                <v-btn icon small>
                    <v-icon color="orange" @click="edit">edit</v-icon>
                </v-btn>
                <v-btn icon small @click="destroy">
                    <v-icon color="red">delete</v-icon>
                </v-btn>
            </v-card-actions>
        </div>
    </v-card>
</template>

<script>
    import EditReply from './EditReply'
    import Likes from '../Likes/ReplyLikes/Likes'

    export default {
        props: ['data', 'index'],
        components: { EditReply, Likes },
        data() {
            return {
               isEdit:false,
               beforeEditReplyBody:'',
            }
        },
        created() {
            this.listen()
        },
        computed: {
            own() {
                return User.own(this.data.user_id)
            },
            reply() {
                return md.parse(this.data.body)
            }
        },
        methods: {                                                                      
            destroy() {
                EventBus.$emit('deleteReply', this.index)
            },
            edit() {
                this.isEdit = true
                this.beforeEditReplyBody = this.data.body
            },
            listen() {
                EventBus.$on('cancelUpdate', (reply) => {
                    this.isEdit = false
                    if (!reply == this.data.reply) {
                        this.data.body = this.beforeEditReplyBody
                        this.beforeEditReplyBody = ''
                    }
                })
            },
        }
    }
</script>