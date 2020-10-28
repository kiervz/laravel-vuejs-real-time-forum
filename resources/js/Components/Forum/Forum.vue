<template>
    <v-app>
        <v-container>
            <v-layout wrap>
                <v-flex md8>
                    <v-card class="mx-auto rounded-0" height="150px">
                        <v-list-item three-line>
                            <v-list-item-content class="pl-10 pt-10">
                                <v-list-item-title class="headline">
                                    All Questions
                                </v-list-item-title>
                                <v-list-item-subtitle class="mt-4">
                                    {{ this.countQuestions + ' questions'}}
                                </v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </v-card>
                    <question
                        v-for="question in questions" 
                        :key="question.id"
                        :question=question
                    >
                    </question>
                </v-flex>
                <v-flex md4>
                    <app-side-bar></app-side-bar>
                </v-flex>
            </v-layout>
        </v-container>
    </v-app>
</template>

<script>
    import question from './Question'
    import AppSideBar from './AppSideBar'

    export default {
        name: "Forum",
        components: { question, AppSideBar },
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