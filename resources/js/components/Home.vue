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
                    <v-card-text v-model="first_name" class="headline text-xs-center">
                      {{infos.first_name}}
                    </v-card-text>
                  </v-card>
                </v-flex>
                <v-flex xs5 md5 lg5 class="mx-2 py-2">
                  <v-card>
                    <v-toolbar dense flat height="30px">
                      <v-toolbar-title class="subheading">Last Name:</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text v-model="last_name" class="headline text-xs-center">
                      {{infos.last_name}}
                    </v-card-text>
                  </v-card>
                </v-flex>
                <v-flex xs5 md5 lg5  class="mx-2 py-2">
                  <v-card>
                    <v-toolbar dense flat height="30px">
                      <v-toolbar-title class="subheading">Birth Date:</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text v-model="birth_date" class="headline text-xs-center">
                      {{infos.birth_date}}
                    </v-card-text>
                  </v-card>
                </v-flex>
                <v-flex xs5 md5 lg5  class="mx-2 py-2">
                  <v-card>
                    <v-toolbar dense flat height="30px">
                      <v-toolbar-title class="subheading">Age:</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text class="headline text-xs-center">
                      {{age}}
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
                    <v-card-text v-model="province" class="headline text-xs-center">
                      {{infos.province}}
                    </v-card-text>
                  </v-card>
                </v-flex>
                <v-flex xs5 md5 lg5  class="mx-2 py-2">
                  <v-card>
                    <v-toolbar dense flat height="30px">
                      <v-toolbar-title class="subheading">City:</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text v-model="city" class="headline text-xs-center">
                      {{infos.city}}
                    </v-card-text>
                  </v-card>
                </v-flex>
              </v-layout>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-flex>

            <v-btn v-if="idx === 1" class="mb-5"
                color="pink"
                dark
                large
                absolute
                fixed
                bottom
                right
                fab
                @click="redirectEdit()"
              ><v-icon>create</v-icon>
              </v-btn>
              <v-btn v-else class="mb-5"
                  color="pink"
                  dark
                  large
                  absolute
                  fixed
                  bottom
                  right
                  fab
                  @click="redirectAdd()"
                ><v-icon>add</v-icon>
                </v-btn>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import axios from 'axios'
import vue from 'vue'

import moment from 'moment'

export default {

    data: () => ({
        id: "",
        infos: [],
        exists: [],
        first_name: "",
        last_name: "",
        birth_date: "",
        age: "",
        city: "",
        province: "",
        idx: ""
    }),

    created() {
        this.id = this.$route.params.id;
        this.checkExist()
        this.displayList()

        console.log(this.$data)

    },
    beforeMount() {

    },

    mounted() {

    },

    updated() {

    },




    methods: {

        redirectAdd() {
            this.$router.push({
                name: 'Add',
                params: {
                    id: this.id
                }
            })
        },

        redirectEdit() {
            this.$router.push({
                name: 'Edit',
                params: {
                    id: this.id,

                }
            })
        },

        displayList() {
            var vm = this
            axios.post('api/displayData', {
                user_id: vm.id
            }).then(
                function(response) {
                    vue.set(vm.$data, 'infos', response.data.info[0])
                    let birthDate = response.data.info[0].birth_date
                    var a = moment(birthDate, 'YYYY[-]MM[-]DD')
                    var b = moment().format('YYYY[-]MM[-]DD')
                    var c = moment(b)

                    vm.age = c.diff(a, 'years')

                    //vue.set(vm.$data, 'age',  a)
                })
        },

        checkExist() {
            var vm = this
            axios.get('api/checkList').then(
                function(response) {
                    vue.set(vm.$data, 'exists', response.data.information)
                    let checkId = response.data.information.map(a => a.user_id)
                    var j = 0
                    for (var i = 0; i < checkId.length; i++) {
                        if (vm.id == checkId[i]) {
                            j++
                        }
                    }
                    vue.set(vm.$data, 'idx', j)
                })
        }
    }
}
</script>
