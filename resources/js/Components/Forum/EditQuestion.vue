<template>
    <div class="container">
        <div class="col-md-8">
            <div class="black--text text-h5">Edit Question</div>
            <v-form
                ref="form"
                lazy-validation
            >
                <v-text-field
                    v-model="form['title']"
                    label="Title"
                    required
                ></v-text-field>
                
                <vue-simplemde v-model="form['body']" name="body" id="body"/>

                 <v-btn
                    class="mr-4"
                    color="primary"
                    @click="update"
                >
                    <v-icon left>save</v-icon>
                    save
                </v-btn>
                <v-btn
                    class="mr-4"
                    color="normal"
                    @click="cancel"
                >
                    <v-icon left>cancel</v-icon>
                    cancel
                </v-btn>
            </v-form>
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
            update() {
                Swal.fire({
                    title: 'Are you update?',
                    text: "You won't be able to revert this!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.patch(`/api/question/${this.form.slug}`, this.form)
                            .then(({data}) => { 
                                Toast.fire({
                                    icon: data.status,
                                    title: data.message
                                });
                                this.cancel();
                             })
                            .catch(error => console.log(error.response.data))
                    }
                })
            },
            cancel() {
                EventBus.$emit('cancelEdit')
            }
        }
    }
</script>