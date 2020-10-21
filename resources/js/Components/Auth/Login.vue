<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{message}}</div>
                    
                    <div class="card-body">
                        <span class="alert alert-danger form-control p-2 text-center" v-if="error ? 'invalid-feedback d-block' : ''">
                            <strong>{{ error }}</strong>
                        </span>
                        <form @submit.prevent="login">
                            
                            <div v-for="(item, $index) in items" :key="$index" class="form-group">
                                <div class="form-group">
                                    <label :for="item.name">{{ item.label }}</label>
                                    <input 
                                        class="form-control"
                                        :type="item.type"
                                        :name="item.name"
                                        v-model="form[item.name]"
                                        :class="errors[item.name] ? 'is-invalid' : ''"
                                    >
                                    <div v-for="(err, i) in errors[item.name]" :key="i">
                                        <span role="alert" :class="errors[item.name] ? 'invalid-feedback d-block' : ''">
                                            <strong>{{ err }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mt-4">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                        <label class="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary form-control">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <router-link to="/signup">Create you account</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                message: "Login your account.",
                form: {
                    email: null,
                    password: null,
                },
                items: [
                    {
                        label: 'Email',
                        name: 'email',
                        required: 'required',
                        type: 'email'
                    },
                    {
                        label: 'Password',
                        name: 'password',
                        required: 'required',
                        type: 'password'
                    },
                ],
                error: null,
                errors:[],
            }
        },
        created() {
            if(User.loggedIn()) {
                this.$router.push({ name: 'forum'});
            }
        },
        methods: {
            login() {
                axios.post('api/auth/login', this.form)
                    .then(response => { User.responseAfterLogin(response) })
                    .catch(error => {
                        if (error.response.status == '401') {
                            this.error = error.response.data.error;
                            this.errors = [];
                        } else {
                            this.errors = error.response.data.errors;
                            this.error = null;
                        }
                    });
            }
        }
    }
</script>