<template>
    <div class="container-fluid">
        <div class="col-md-8">
            <div class="">
                <div class="card border-0">
                    <div class="card-body">
                        <h2>All Questions</h2>
                        <p>{{ questions.length + ' questions'}}</p>
                    </div>
                </div>
            </div>
            <question 
                v-for="question in questions" 
                :key="question.path"
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
            }
        },
        created() {
            this.getAllQuestions();
        },
        methods: {
            getAllQuestions() {
                axios.get('api/question')
                    .then(res => this.questions = res.data.data)
                    .catch(error => error.response.data)
            }
        }
    }
</script>