<template>
    <v-container>
        <v-row>
            <v-flex md10>
                <div class="text-h5">{{ question.title }}</div>
                <div class="grey--text mt-2 caption">Asked <span class="text--primary">{{ question.created_at }}</span></div>
            </v-flex>
            <v-flex md2 v-if="own">
                <v-btn small color="primary" @click="edit">Edit</v-btn> 
                <v-btn small color="error" @click="destroy">Delete</v-btn>
            </v-flex>
        </v-row>
        <v-row>
            <v-flex md12 class="mt-2">
                <v-divider></v-divider>
            </v-flex>
        </v-row>
        <v-row>
            <v-flex md9>
                <v-row>
                    <div class="col-md-2 text-center" dark>
                        <v-btn icon> 
                            <v-icon color="dark">
                                thumb_up
                            </v-icon>
                        </v-btn>
                        <div class="p-1 mt-3 mb-3">{{ question.id }}</div>
                        <v-btn icon> 
                            <v-icon color="dark">
                                thumb_down
                            </v-icon>
                        </v-btn>
                    </div>
                    <div class="col-md-10 text-justify">
                        <p v-html="body"></p>
                        <div class="float-right">
                            <div class="grey--text caption">
                                Asked <span class="text--primary">{{ question.created_at_r }}</span>
                            </div>
                            <router-link :to="question.user_path" class="text-decoration-none float-right">
                                {{ question.user_name }}
                            </router-link>
                        </div>
                    </div>
                </v-row>
            </v-flex>
            <v-flex md3>
            </v-flex>
        </v-row>
        <v-row>
            <v-flex md9>
                <div class="mt-4">
                    <div class="black--text text-h6" v-if="reply_count > 1">{{ reply_count + ' Answers'}}</div>
                    <div class="black--text text-h6" v-else>{{ reply_count + ' Answer'}}</div> 
                </div>
            </v-flex>
            <v-flex md3></v-flex>
        </v-row>
    </v-container>
</template>

<script>
    import Reply from '../Reply/Reply'

    export default {
        name: "ShowQuestion",
        components: {Reply},
        props: ['question'],
        data() {
            return {
                own: User.own(this.question.user_id),
                form: {
                    reply:null,
                },
                reply_count: this.question.reply_count
            }
        },
        created() {
            this.listen()
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
            },
            listen() {
                EventBus.$on('plusReplyCount', () => {
                    this.reply_count += 1
                })

                EventBus.$on('minusReplyCount', () => {
                    this.reply_count -= 1
                })

                EventBus.$on('cancelEdit', (data) => {
                    this.question.title = data
                })
            }
        }
    }
</script>