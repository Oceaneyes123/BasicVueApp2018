<template>
<v-app id="inspire">
    <v-content>
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4>
                    <v-card class="elevation-12">
                        <v-toolbar dark color="primary">
                            <v-toolbar-title>Register</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-form v-model="valid" ref="form">
                                <v-text-field prepend-icon="person" :rules="nameRules" v-model="username" label="Username" type="text"></v-text-field>
                                <v-text-field id="password"
                                prepend-icon="lock"
                                :rules="passwordRules"
                                :error-messages="error"
                                v-model="password"
                                label="Password"
                                type="password"></v-text-field>
                                <v-text-field id="confirm_password"
                                prepend-icon="lock"
                                :rules="confirmRules"
                                :error-messages="error"
                                v-model="confirm_password"
                                label=" Confirm Password"
                                type="password"></v-text-field>
                            </v-form>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn  color="primary" @click="registerAccount()">Register</v-btn>
                        </v-card-actions>
                    </v-card>
                    <v-alert
                        ref="alert"
                        dismissible
                        type="success"
                      >
                        This is a success alert that is closable.
                      </v-alert>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
</v-app>
</template>

<script>
import axios from 'axios'
import vue from 'vue'


export default {

    data: () => ({
        valid: false,
        username: "",
        password: "",
        confirm_password: "",
        error: "",
        route: "",
        nameRules: [
            v => !!v || 'Userame is required'
        ],
        passwordRules: [
            v => !!v || 'Password is required'
        ],
        confirmRules: [
            v => !!v || 'Confirm your password'
        ],
    }),

    methods: {


        registerAccount() {
            var vm = this

            const form = new FormData()
            form.append('username', vm.username)
            form.append('password', vm.password)
            if (this.password == this.confirm_password) {
                if (this.$refs.form.validate()) {
                    axios.post('api/registerAccount', form).then(function(response) {})
                    this.$router.push('/Main')
                }
            } else {
                this.error = "Password Not Match"

            }
        },



    },

}
</script>
