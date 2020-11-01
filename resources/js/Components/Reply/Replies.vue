<template>
    <v-container>
        <v-flex md9>
            <reply 
                v-for="reply in content" 
                :key="reply.id"
                :data="reply"
                >
            </reply>
                <v-divider></v-divider>
        </v-flex>
    </v-container>
</template>

<script>
    import Reply from './Reply'
    
    export default {
        props: ['replies'],
        components: { Reply },
        data() {
            return {
                content: this.replies,
            }
        },
        created() {
            this.listen();
        },
        methods: {
            listen() {
                EventBus.$on('newReply', (reply) => {
                    this.content.unshift(reply)
                    window.scrollTo(0,0)
                })
            }
        }
    }
</script>