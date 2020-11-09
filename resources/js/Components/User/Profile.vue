<template>
    <div>
        <not-found v-show="!findUser"></not-found>
        <v-card v-show="findUser">
            <div class="text-center">
                <v-avatar class="mt-3"
                    color="primary"
                    size="100"
                ><span class="white--text headline">KM</span></v-avatar>
                <h2>{{ profile.name }}</h2>
                <br>
            </div>
        </v-card>
        
        <v-row>
            <div class="col-md-2 col-lg-1"></div>
            <div class="col-md-8 col-lg-10">   
                <v-card class="mx-auto mt-2">
                    <question
                        v-for="question in questions" 
                        :key="question.id"
                        :question=question
                        :inprofile=true
                    >
                    </question>
                </v-card>
            </div>
            <div class="col-md-2 col-lg-10"></div>
        </v-row>
    </div>
</template>
<script>
    import question from '../Forum/Question'
    import NotFound from '../NotFound'

    export default {
        components: { NotFound, question },
        data() {
            return {
                questions: {},
                findUser: true,
                profile: {},
            }
        },
        mounted() {
            this.getUser()
        },
        methods: {
            getUser() {
                axios.post(`/api/user/${this.$route.params.id}`)
                    .then(({data}) => {
                        this.profile = data.user
                        this.questions = data.user_questions
                    })
                    .catch(error => this.findUser = false)
            },
        }
    }
</script>