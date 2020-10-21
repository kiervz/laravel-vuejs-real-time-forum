<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{message}}</div>

                    <div class="card-body">
                        <form @submit.prevent="signup">

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

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary form-control">
                                        Sign Up
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Signup",
        data() {
            return {
                message: "Create your account.",
                form: {
                    name: null,
                    email: null,
                    password: null,
                    password_confirm: null,
                }, 
                items: [
                    {
                        label: 'Name',
                        name: 'name',
                        required: 'required',
                        type: 'text'
                    },
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
                    {
                        label: 'Confirm Password',
                        name: 'password_confirm',
                        required: 'required',
                        type: 'password'
                    },
                ],
                errors: []
            }
        },
        created() {
            if(User.loggedIn()) {
                this.$router.push({ name: 'forum'});
            }
        },
        methods: {
            signup() {
                axios.post('api/auth/signup', this.form)
                    .then(res => {
                        User.responseAfterLogin(res);
                    })
                    .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>