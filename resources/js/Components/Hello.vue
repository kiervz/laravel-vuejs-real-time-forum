<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        I'm a {{ message }}
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Title</th>
                                <th>Body</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="question in questions" :key="question.id">
                                <td>{{ question.id }}</td>
                                <td>{{ question.title }}</td>
                                <td>{{ question.body }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "HelloComponents",
        data() {
            return {
                message: "Hello WOrld",
                questions: []
            }
        },
        mounted() {
            console.log('Hello Component mounted.')
        },
        created() {
            axios.get('api/question')
                .then(({ data }) => { 
                    this.questions = data.data 
                    console.log(data.data) 
                })
                .catch(err => console.log("Error :", err))
        }
    }
</script>