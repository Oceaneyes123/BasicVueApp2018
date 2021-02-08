<template>
<v-app id="inspire">
    <v-content>
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4>
                    <v-snackbar v-model="snackbar" top right color="error">Wrong Email or Password</v-snackbar>
                    <v-card class="elevation-12">
                        <v-toolbar dark color="primary">
                            <v-toolbar-title>Sign-In</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-form>
                                <v-text-field prepend-icon="person" v-model="username" label="Username" type="text"></v-text-field>
                                <v-text-field id="password" prepend-icon="lock" v-model="password" label="Password" type="password"></v-text-field>
                            </v-form>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn flat color="primary" :to="'/Register'">Register</v-btn>
                            <v-btn color="primary"  @click="getList()">Login</v-btn>
                        </v-card-actions>
                    </v-card>
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
        snackbar: false,
        lists: [],
        informations: [],
        username: "",
        password: "",
        idx: "",
    }),


    methods: {

        getList() {

            var vm = this
            axios.post('api/getList').then(
                function(response) {
                    vue.set(vm.$data, 'lists', response.data.list)
                    let checkId = response.data.list.map(a => a.id)
                    let checkUser = response.data.list.map(a => a.username)
                    let checkPassword = response.data.list.map(a => a.password)
                    var j = 0
                    var id = 0;
                    for (var i = 0; i < checkUser.length; i++) {
                        if (vm.username == checkUser[i] && vm.password == checkPassword[i]) {
                            j++
                            id = checkId[i]
                            console.log(id)
                        }
                    }
                    if (j == 0) {
                        vm.snackbar = "true"
                    } else if (j == 1) {
                        vm.$router.push({
                            name: 'Home',
                            params: {
                                id: id
                            }
                        })
                    }
                })
        },

        checkList() {
            var vm = this
            axios.get('api/checkList').then(
              function (response) {
                vue.set(vm.$data, 'informations', response.data.information)
                let idx
                let checkUserId = response.data.information.map(a => a.user_id)
                for (var i = 0; i < checkUserId.length; i++) {
                    idx = checkUserId[i]
                    vm.idx = idx
                }
                return idx
            })
        },


    },
}
</script>
