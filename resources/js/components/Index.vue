<template>
    <v-app>
      <v-content>
        <router-view></router-view>
      </v-content>
    </v-app>
</template>

<script>

import axios from 'axios'
import vue from 'vue'

    export default {

      data: () => ({

      }),

      beforeMount(){
          console.log("M - before Mount")
            this.$router.push('/Main')
      },

    }
</script>
