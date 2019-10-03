<template>
  <v-app id="inspire">

    <v-app-bar
      app
      clipped-right
      color="#3474eb"
      dark
      fixed
    >
      <v-toolbar-title>Transcycle Debtor Locator System</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn depressed v-if="!this.loggedIn" color="blue" @click="dialog = !dialog">Login</v-btn>
    </v-app-bar>

    <v-navigation-drawer
      :value="drawer"
      src="https://cdn.vuetifyjs.com/images/backgrounds/bg-2.jpg"
      app
      v-if="this.loggedIn"
      dark
    >
      <v-list-item>
        <v-list-item-avatar>
          <v-img src="https://randomuser.me/api/portraits/men/78.jpg"></v-img>
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title>{{ this.auth_user.user.full_name }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
        <template v-slot:append>
        <div class="pa-2">
          <v-btn block @click="logout">Logout</v-btn>
        </div>
      </template>
    </v-navigation-drawer>

    <v-content>
      <v-container
        fluid
        fill-height
      >
        <v-layout
          justify-center
          align-center
        >
          <v-flex shrink>
            <router-view></router-view>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>

    <v-footer
      app
      color="#1f2d54"
      class="white--text"
    >
      <v-spacer></v-spacer>
      <span>LonerDev &copy; 2019</span>
    </v-footer>

    <div class="text-center">
    <v-dialog
      v-model="dialog"
      width="500"
    >

      <v-card>
        <v-card-title
          class="headline"
          primary-title
        >
          Login
        </v-card-title>

        <v-card-text>
          <Login />
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
  </v-app>
</template>
<script>
import Login from './Login'
import { mapState, mapActions } from 'vuex'
export default {
    name: 'App',
    components:{ Login },
    data:() => ({
        dialog: false
    }),
    created(){
        this.checkAppStatus()
    },
    computed:{
        ...mapState({
            auth_user: state => state.auth_user,
            drawer: 'drawer',
            loggedIn: 'loggedIn',
            loading: 'loading'
        })
    },
    methods:{
        ...mapActions([
            'logout',
            'checkAppStatus'
        ])
    },
    watch:{
      loading(newValue, oldValue){
        if (newValue == false) {
          this.dialog = false
        }
      }
    }
}
</script>
