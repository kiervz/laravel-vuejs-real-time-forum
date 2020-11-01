<template>
    <div v-if="question">
        <edit-question
            v-if="isEdit"
            :question=question  
            ></edit-question>
        <show-question 
            v-else
            :question=question>
        </show-question>
         <div class="container">
            <replies 
                :replies="question.replies">
            </replies>
            <new-reply :questionSlug="question.slug"></new-reply>
        </div>
    </div>
</template>

<script>
    import ShowQuestion from './ShowQuestion'
    import EditQuestion from './EditQuestion'
    import Replies from '../Reply/Replies'
    import NewReply from '../Reply/NewReply'

    export default {
        components: { ShowQuestion, EditQuestion, Replies, NewReply },
        data() {
            return {
                question: null,
                isEdit: false,
            }
        },
        created() {
            this.getQuestion()
            this.listen()
        },
        methods: {
            getQuestion() {
                axios.get(`/api/question/${this.$route.params.slug}`)
                    .then(res => this.question = res.data.data)
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