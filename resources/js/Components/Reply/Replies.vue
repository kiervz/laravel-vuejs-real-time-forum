<template>
    <v-container>
        <v-flex md9>
            <reply 
                v-for="(reply, index) in content" 
                :key="reply.id"
                :index=index
                :data="reply"
                >
            </reply>
        </v-flex>
    </v-container>
</template>

<script>
    import Reply from './Reply'
    
    export default {
        props: ['question'],
        components: { Reply },
        data() {
            return {
                content: this.question.replies,
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

                EventBus.$on('deleteReply', (index) => {
                    axios.delete(`/api/question/${this.question.slug}/reply/${this.content[index].id}`)
                        .then(res => {
                            this.content.splice(index, 1)
                        })
                        .catch(error => console.log(error.response.data))
                })
            }
        }
    }
</script>