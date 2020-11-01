<template>
    <div>
        <vue-simplemde v-model="reply.body" name="reply"/>
        <v-card-actions>
            <v-btn icon small>
                <v-icon color="purple" @click="update">save</v-icon>
            </v-btn>
            <v-btn icon small>
                <v-icon color="normal" @click="cancel">cancel</v-icon>
            </v-btn>
        </v-card-actions>
    </div>
</template>
<script>
    export default {
        props: ['reply'],
        methods: {
            cancel(reply) {
                EventBus.$emit('cancelUpdate', reply)
            },
            update() {
                axios.put(`/api/question/${this.reply.question_slug}/reply/${this.reply.id}`, {body:this.reply.body})
                    .then(res => this.cancel(this.reply.body))
                    .catch(error => console.log(error.response.data))
            }
        }
    }
</script>