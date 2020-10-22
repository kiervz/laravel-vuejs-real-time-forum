<template>
    <div class="container-fluid">
        <div class="col-md-8">
            <div class="">
                <div class="card border-0">
                    <div class="card-body">
                        <h2>Create Question</h2>
                        <form @submit.prevent="createQuestion">
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
                                <label for="category">Category</label>
                                <select
                                    name="category"
                                    id="category"
                                    v-model="form['category_id']"
                                    class="form-control"
                                >
                                    <option value="" disabled selected>Select Category</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <vue-simplemde v-model="form['body']" name="body" id="body"/>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary rounded-0">
                                        CREATE
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
        data() {
            return {
                form: {
                    title: null,
                    body: null,
                    category_id: null,
                },
                categories: {},
                items: [
                    {
                        label: 'Title',
                        name: 'title',
                        required: 'required',
                        type: 'text'
                    },
                    {
                        label: 'Category',
                        name: 'category',
                        required: 'required',
                        type: 'dropdown'
                    },
                    {
                        label: 'Question',
                        name: 'question',
                        required: 'required',
                        type: 'text'
                    },
                ],
                errors: []
            }
        },
        created() {
            axios.get('api/category')
                .then(res => {this.categories = res.data.data})
                .catch(error => console.log(error.response.data))
            
        },
        methods: {
            createQuestion() {
                axios.post('api/question', this.form)
                    .then(res => {
                        this.$router.push(res.data[0].path);
                    })
                    .catch(error => console.log(error.response.data))
            }
        }
    }
</script>

<style>
    @import '~simplemde/dist/simplemde.min.css';
</style>