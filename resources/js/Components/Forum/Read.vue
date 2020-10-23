<template>
    <div class="container">
        <edit-question
            :question=question  
            v-if="isEdit"
            ></edit-question>
        <div v-else>
            <show-question 
            :question=question 
            :replies=replies 
            v-if="question">
            </show-question>
        </div>
    </div>
</template>

<script>
    import ShowQuestion from './ShowQuestion'
    import EditQuestion from './EditQuestion'

    export default {
        components: { ShowQuestion, EditQuestion },
        data() {
            return {
                question: null,
                replies: {},
                isEdit: false,
            }
        },
        created() {
            this.getQuestion()
            this.getReply()
            this.listen()
        },
        methods: {
            getQuestion() {
                axios.get(`/api/question/${this.$route.params.slug}`)
                    .then(res => this.question = res.data.data)
                    .catch(error => console.log(error.response.data))
            }, 

            getReply() {
                axios.get(`/api/question/${this.$route.params.slug}/reply`)
                    .then(res => this.replies = res.data.data)
                    .catch(error => console.log(error.response.data))
            },

            listen() {
                EventBus.$on('startEdit', () => {
                    this.isEdit = true;
                })

                EventBus.$on('cancelEdit', () => {
                    this.isEdit = false;
                })
            },
        }
    }
</script>