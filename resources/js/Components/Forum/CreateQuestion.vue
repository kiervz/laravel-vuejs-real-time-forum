<template>
    <div class="container">
        <div class="col-md-8">
            <div class="black--text text-h5">Create Question</div>
            <v-form
                ref="form"
                lazy-validation
            >
                <v-text-field
                    v-model="form['title']"
                    label="Title"
                    required
                ></v-text-field>
                <v-select
                    v-model="form['category_id']"
                    :items="categories"
                    item-text="name"
                    item-value="id"
                    label="Category"
                    required
                ></v-select>
                
                <vue-simplemde v-model="form['body']" name="body" id="body"/>

                 <v-btn
                    class="mr-4"
                    color="primary"
                    @click="createQuestion"
                >
                    submit
                </v-btn>
            </v-form>
        </div>
        <div class="col-md-4">

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    title: null,
                    body: null,
                    category_id: null,
                },
                categories: [],
                errors: {}
            }
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push('/');
            }
            this.getCateogries()
        },
        methods: {
            createQuestion() {
                this.$Progress.start()
                axios.post('/api/question', this.form)
                    .then(res => {
                        this.$router.push(res.data[0].path);
                        this.$Progress.finish()
                    })
                    .catch(error => {
                        console.log(error.response.data)
                        this.$Progress.fail()
                    })
            },
            getCateogries() {
                axios.get('/api/category')
                    .then(res => {this.categories = res.data.data})
                    .catch(error => console.log(error.response.data))
            }
        }
    }
</script>

<style>
    @import '~simplemde/dist/simplemde.min.css';
</style>