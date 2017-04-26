<template>
    <div class="jumbotron vertical-center no-padding no-margin">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-8 offset-md-4 offset-sm-2">
                    <form method="post" class="form-horizontal base-form" @submit.prevent="validateBeforeSubmit">
                        <div class="form-group">
                            <h1 class="form-title">Welcome! Please login.</h1>
                        </div>

                        <div :class="classFor('email', 'form-group', 'has-danger')">
                            <label class="col-form-label" for="email">Email address</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="Enter email"
                                v-validate="'required|email'"
                                v-model="form.email"
                                :class="classFor('email', 'form-control', 'form-control-danger')"
                            />
                            <small
                                v-show="errors.has('email')"
                                class="form-control-feedback"
                            >
                                {{errors.first('email')}}
                            </small>
                        </div>

                        <div :class="classFor('password', 'form-group', 'has-danger')">
                            <label class="col-form-label" for="password">Password</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Password"
                                v-validate="'required'"
                                v-model="form.password"
                                :class="classFor('password', 'form-control', 'form-control-danger')"
                            />
                            <small
                                v-show="errors.has('password')"
                                class="form-control-feedback"
                            >
                                {{errors.first('password')}}
                             </small>
                        </div>

                        <div class="form-group">
                            <label for="remember">
                                <input type="checkbox" id="remember" v-model="form.remember"/>
                                Remember me
                            </label>
                            <router-link class="link-forgot-password" to="password.request">
                                Forgot password
                            </router-link>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        data() {
            let form = {
                email: '',
                password: '',
                remember: false
            }

            return {form}
        },

        computed: {
            ...mapState('auth', 'user')
        },

        methods: {
            classFor(field, normal, error) {
                return this.errors.has(field) ? `${normal} ${error}` : normal
            },

            validateBeforeSubmit() {
                this.$validator.validateAll().then(() => {
                    this.handleLoginProcess()
                }).catch(() => {})
            },

            handleLoginProcess() {
                this.$store.dispatch('auth/login', this.form)
            }
        },

        updated() {
            if (this.user) {
                this.$router.go({name: 'Dashboard'})
            }
        }
    }
</script>

<style lang="scss">
    .app-container {
        background: #f1f1f1;
        min-height: 100vh;
    }

    .vertical-center {
        min-height: 100%;
        min-height: 100vh;

        display: flex;
        align-items: center;
    }

    .no-padding {
        padding: 0;
    }

    .no-margin {
        margin: 0;
    }

    .base-form {
        .form-title {
            font-size: 1.8em;
            text-align: center;
            color: #2e6da4;
        }

        .link-forgot-password {
            float: right;
        }

        a {
            text-decoration: none;
        }
    }
</style>
