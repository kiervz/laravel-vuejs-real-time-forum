<template>
    <div class="container-fluid">
        <div class="col-md-8">
            <div class="">
                <div class="card border-0">
                    <div class="card-body">
                        <h2>Edit Question</h2>
                        <form @submit.prevent="updateQuestion">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input 
                                    class="form-control"
                                    type="text"
                                    name="title"
                                    v-model="form['title']"
                                >
                            </div>
                            
                            <div class="form-group">
                                <vue-simplemde v-model="form['body']" name="body" id="body"/>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary rounded-0">
                                        UPDATE
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">

        </div>
    </div>
</template>

<script>
    export default {
        props: ['question'],
        data() {
            return {
                form: {
                    title: null,
                    body: null,
                },
            }
        },
        mounted() {
            this.form = this.question
        },
        methods: {
            updateQuestion() {
                axios.patch(`/api/question/${this.form.slug}`, this.form)
                    .then(res => this.cancel())
                    .then(error => console.log(error.response.data))
            },
            cancel() {
                EventBus.$emit('cancelEdit')
            }
        }
    }
</script>