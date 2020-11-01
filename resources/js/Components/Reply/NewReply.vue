<template>
    <v-container>
        <v-flex md9>
            <div class="black--text text-h6 mb-2">Your Answer</div>

            <vue-simplemde v-model="reply" name="reply"/>
            <v-btn color="primary" @click="submit">
                Post Your Answer
            </v-btn>
        </v-flex>
    </v-container>
</template>
<script>
    import md from 'marked'

    export default {
        props: ['questionSlug'],
        data() {
            return {
                reply:null,
            }
        },
        methods: {
            submit() {
                axios.post(`/api/question/${this.questionSlug}/reply`, {body:this.reply})
                    .then(res => {
                        this.reply = ''
                        EventBus.$emit('newReply', res.data.reply)
                    })
                    .catch(error => console.log(error.response.data))
            }
        }
    }
</script>