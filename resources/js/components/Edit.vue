<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md6>
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title class="headline font-weight-bold">Personal Information</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
              <v-layout row wrap justify-center>
                <v-flex xs5 md5 lg5  class="mx-2 py-2">
                  <v-card>
                    <v-toolbar dense flat height="30px">
                      <v-toolbar-title class="subheading">First Name:</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text class="headline text-xs-center">
                      <v-text-field v-model = "first_name"></v-text-field>
                    </v-card-text>
                  </v-card>
                </v-flex>
                <v-flex xs5 md5 lg5 class="mx-2 py-2">
                  <v-card>
                    <v-toolbar dense flat height="30px">
                      <v-toolbar-title class="subheading">Last Name:</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text class="headline text-xs-center">
                    <v-text-field v-model = "last_name"></v-text-field>
                    </v-card-text>
                  </v-card>
                </v-flex>
                <v-flex xs10 md10 lg10  class="py-2">
                  <v-card>
                    <v-toolbar dense flat height="30px">
                      <v-toolbar-title class="subheading">Birth Date:</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text class="headline text-xs-center">
                      <v-menu
                          :close-on-content-click="false"
                          v-model="menu"
                          :nudge-right="40"
                          lazy
                          transition="scale-transition"
                          offset-y
                          full-width
                          min-width="290px"
                        >
                          <v-text-field
                            slot="activator"
                            v-model="birth_date"
                            label="Picker without buttons"
                            prepend-icon="event"
                            readonly
                          ></v-text-field>
                          <v-date-picker v-model="birth_date" @input="menu2 = false"></v-date-picker>
                        </v-menu>
                    </v-card-text>
                  </v-card>
                </v-flex>

                <v-flex xs12>
                  <v-card flat>
                    <v-card-text class="headline primary--text
                    font-weight-bold">Address</v-card-text>
                  </v-card>
                </v-flex>
                <v-flex xs5 md5 lg5  class="mx-2 py-2">
                  <v-card>
                    <v-toolbar dense flat height="30px">
                      <v-toolbar-title class="subheading">Province:</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text class="headline text-xs-center">
                      <v-text-field v-model = "province"></v-text-field>
                    </v-card-text>
                  </v-card>
                </v-flex>
                <v-flex xs5 md5 lg5  class="mx-2 py-2">
                  <v-card>
                    <v-toolbar dense flat height="30px">
                      <v-toolbar-title class="subheading">City:</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text class="headline text-xs-center">
                      <v-text-field v-model = "city"></v-text-field>
                    </v-card-text>
                  </v-card>
                </v-flex>
              </v-layout>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click="updateData()">Update</v-btn>
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
        id: "",
        menu: "",
        first_name: "",
        last_name: "",
        birth_date: "",
        province: "",
        city: "",
    }),

    created() {
        this.id = this.$route.params.id;
        console.log(this.id)
    },

    methods: {

      updateData(){
        var vm = this
        const form = new FormData()
        form.append('user_id', vm.id)
        form.append('first_name', vm.first_name)
        form.append('last_name', vm.last_name)
        form.append('birth_date', vm.birth_date)
        form.append('province', vm.province)
        form.append('city', vm.city)
        console.log(form)
        axios.post('api/updateData', form).then(
          function(response){
            console.log(response.data)
          })
          this.$router.push({
              name: 'Home',
              params: {
                  id: vm.id
              }
          })
      }

    },

}
</script>
