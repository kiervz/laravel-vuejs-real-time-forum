<template>
    <div class="container-fluid">
        <div class="col-md-8">
            <div class="">
                <div class="card border-0">
                    <div class="card-body">
                        <h2>All Questions</h2>
                    </div>
                    
                    <p class="ml-3">{{ this.countQuestions + ' questions'}}</p>
                </div>
            </div>
            <question 
                v-for="question in questions" 
                :key="question.id"
                :question=question
            >
            </question>
        </div>
        <div class="col-md-4">

        </div>
    </div>
</template>

<script>
    import question from './Question'

    export default {
        name: "Forum",
        components: { question },
        data() {
            return {
                questions: {},
                countQuestions: 0,
            }
        },
        created() {
            this.getAllQuestions();
        },
        methods: {
            getAllQuestions() {
                this.$Progress.start()
                axios.get('api/question')
                    .then(res => {
                        this.questions = res.data.data;
                        this.countQuestions = this.questions.length;
                        this.$Progress.finish()
                    })
                    .catch(error => {
                        error.response.data
                        this.$Progress.fail()
                    })
            },
        }
    }
</script>