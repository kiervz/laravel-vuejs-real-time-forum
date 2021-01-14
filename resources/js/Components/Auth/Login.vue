<template>
    <div class="container">
        <v-row>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <v-card class="mx-auto">
                    <v-card-text>
                        <v-alert
                            dense
                            outlined
                            type="error"
                            v-if="error"
                            >
                            {{ error }}
                        </v-alert>
                        <v-form
                            ref="form"
                            lazy-validation
                        >
                            
                            <v-text-field
                                v-model="form['email']"
                                label="Email"
                                type="email"
                            ></v-text-field>
                            <span class="red--text" v-if="errors.email">{{ errors.email[0] }}</span>
                            
                            <v-text-field
                                v-model="form['password']"
                                type="password"
                                label="Password"
                                
                            ></v-text-field>
                            <span class="red--text" v-if="errors.password">{{ errors.password[0] }}</span>
                            
                            <v-btn 
                                class="mr-4" 
                                color="primary"
                                @click="login"
                                block>
                                Login
                            </v-btn>
                        </v-form>
                        <div class="mt-5 text-center">
                            <router-link to="/signup" class="text-decoration-none">Create your Account</router-link>
                        </div>
                    </v-card-text>
                </v-card>
            </div>
            <div class="col-md-3"></div>
        </v-row>
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
                error: null,
                errors:{},
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
                        let status = error.response.status
                        if (!status == 401 || status == 422) {
                            this.errors = error.response.data.errors
                        }
                        else if (status == 429) {
                            this.error = error.response.data.errors.email[0]
                        }
                        else { 
                            this.error = error.response.data.error
                        }
                    });
            }
        }
    }
</script>