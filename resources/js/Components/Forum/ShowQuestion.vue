<template>
    <div>
        <div class="row">
            <div class="col-md-9">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <h3>{{ question.title }}</h3>
                            </div>
                            <div class="col-md-2" v-if="own">
                                <button class="btn btn-primary btn-sm" @click="edit">Edit</button> 
                                <button class="btn btn-danger btn-sm" @click="destroy">Delete</button>
                            </div>
                        </div>
                        <p><small class="text-muted">{{ 'Asked ' + question.created_at }}</small></p>
                        <hr>
                        <div class="row">
                            <div class="col-md-2 text-center">
                                <button class="btn btn-primary btn-sm">Like</button>
                                <h4 class="p-1 mt-3 mb-3 text-muted">{{ question.id }}</h4>
                                <button class="btn btn-primary btn-sm">Like</button>
                            </div>
                            <div class="col-md-10 text-justify">
                                <p v-html="body"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="mt-4">
                    <h5 v-if="replies.length > 1">{{ replies.length + ' Answers'}}</h5>
                    <h5 v-else>{{ replies.length + ' Answer'}}</h5> 
                </div>
                <reply :replies=replies></reply>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
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