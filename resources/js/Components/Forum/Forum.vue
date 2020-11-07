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
                    <div class="text-center">
                        <v-container>
                            <v-row justify="center">
                                <v-col cols="10">
                                    <v-container class="max-width">
                                        <v-pagination
                                            v-model="meta.current_page"
                                            class="my-4"
                                            :length="meta.last_page"
                                            @input="fetchQuestions"
                                            :total-visible="7">
                                        </v-pagination>
                                    </v-container>
                                </v-col>
                            </v-row>
                        </v-container>
                    </div>
                    <br>
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
                meta: {},
            }
        },
        created() {
            this.fetchQuestions();
        },
        methods: {
            fetchQuestions(page) {
                let url = page ? `api/question?page=${page}` : 'api/question'
                this.$Progress.start()
                axios.get(url)
                    .then(res => {
                        this.questions = res.data.data;
                        this.meta = res.data.meta;
                        this.countQuestions = res.data.meta.total;
                        this.$Progress.finish()
                        window.scrollTo(0,0)
                    })
                    .catch(error => {
                        error.response.data
                        this.$Progress.fail()
                    })
            },
        }
    }
</script>