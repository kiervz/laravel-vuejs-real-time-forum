<template>
    <v-container>
        <v-row>
            <v-flex md10>
                <div class="text-h5">{{ question.title }}</div>
                <div class="black--text mt-3 caption">{{ 'Asked ' + question.created_at }}</div>
            </v-flex>
            <v-flex md2 v-if="own">
                <v-btn small color="primary" @click="edit">Edit</v-btn> 
                <v-btn small color="error" @click="destroy">Delete</v-btn>
            </v-flex>
        </v-row>
        <v-divider></v-divider>
        <v-row>
            <v-flex md9>
                <v-row>
                    <div class="col-md-2 text-center" dark>
                        <v-btn icon> 
                            <v-icon dark>
                                thumb_up
                            </v-icon>
                        </v-btn>
                        <div class="p-1 mt-3 mb-3">{{ question.id }}</div>
                        <v-btn icon> 
                            <v-icon dark>
                                thumb_down
                            </v-icon>
                        </v-btn>
                    </div>
                    <div class="col-md-10 text-justify">
                        <p v-html="body"></p>
                    </div>
                </v-row>
            </v-flex>
            <v-flex md3>
            </v-flex>
        </v-row>
        <v-row>
            <v-flex md9>
                <div class="mt-4">
                    <div class="black--text text-h6" v-if="replies.length > 1">{{ replies.length + ' Answers'}}</div>
                    <div class="black--text text-h6" v-else>{{ replies.length + ' Answer'}}</div> 
                </div>
                <v-divider></v-divider>
                <reply :replies=replies></reply>
                <div class="black--text text-h6 mb-2">Your Answer</div>
                <v-form
                    ref="form"
                    lazy-validation
                >
                    <vue-simplemde v-model="form['reply']" name="reply" id="reply"/>
                    <v-btn
                        color="primary"
                    >
                        Post Your Answer
                    </v-btn>
                </v-form>
            </v-flex>
            <v-flex md3></v-flex>
        </v-row>
    </v-container>
</template>

<script>
    import Reply from './Reply'
    import md from 'marked'

    export default {
        name: "ShowQuestion",
        components: {Reply},
        props: ['question', 'replies'],
        data() {
            return {
                own: User.own(this.question.user_id),
                form: {
                    reply:null,
                }
            }
        },
        computed: {
            body() {
                return md.parse(this.question.body);
            }
        },
        methods: {
            destroy() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/api/question/${this.question.slug}`)
                            .then(({data}) => { 
                                this.$router.push('/')
                                Toast.fire({
                                    icon: data.status,
                                    title: data.message
                                });
                             })
                            .catch(error => console.log(error.response.data))
                    }
                })
                
            },
            edit() {
                EventBus.$emit('startEdit');
            }
        }
    }
</script>