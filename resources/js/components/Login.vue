<template>
  <form>
    <v-text-field
      autofocus
      v-model="username"
      label="Username"
      required
      :loading="loading"
    ></v-text-field>
    <v-text-field
      v-model="password"
      label="Password"
      required
      type="password"
      :loading="loading"
      @keydown.enter="submit"
    ></v-text-field>
    <v-spacer></v-spacer>
    <v-btn :loading="loading" class="mr-4 white--text" @click="submit" color="blue">submit</v-btn>
    <v-btn color="red white--text" class="" @click="clear">clear</v-btn>
  </form>
</template>
<script>
    import { mapState, mapActions } from 'vuex'
    export default {
        data: () => ({
            username: '',
            password: ''
        }),
        mounted () {
        },
        computed:{
            ...mapState({
                auth_user: state => state.auth_user,
                loading: 'loading'
            })
        },
        methods: {
            ...mapActions([
                'login'
            ]),
            submit () {
                let data = {
                    username: this.username,
                    password: this.password
                }
                this.login(data)
            },
            clear () {
                this.username = ''
                this.password = ''
            }
        },
        watch:{
            loading(newValue, oldValue){
                if (newValue == false) {
                    this.clear()
                }
            }
        }
    }
</script>
