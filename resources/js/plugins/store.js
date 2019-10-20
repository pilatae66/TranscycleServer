import Vue from 'vue'
import axios from "axios";
import Vuex from 'vuex'
import router from '../routes/router'

Vue.use(Vuex)
let localURL = 'http://localhost:8000'
let serverURL = 'http://transcycle-server.herokuapp.com'
let url = localURL


export default new Vuex.Store({
    state:{
        loading: false,
        drawer:false,
        loggedIn: false,
        auth_user:{
            user:{},
            token:''
        },
        customers:[],
        due_customers: []
    },
    mutations:{
        LOGIN(state, payload){
            if (payload.user.role == 'Collector') {
                state.auth_user.user = payload.user
                state.auth_user.token = payload.token
                state.loading = false
                setTimeout(() => {
                    state.loggedIn = true
                }, 500);
                state.drawer = true
                localStorage.setItem('auth_user', JSON.stringify(payload))
                router.push('/customerlist')
                Vue.swal('Success!', 'Logged in Successfully!', 'success')
            }
            else{
                Vue.swal('Error!', 'Invalid Username / Password', 'error')
                state.loading = false
            }
        },
        LOGOUT(state){
            state.auth_user = {
                user:{},
                token:''
            }
            state.drawer = false
            setTimeout(() => {
                state.loggedIn = false
            }, 500);
            localStorage.removeItem('auth_user')
            router.push('/')
            Vue.swal('Success!', 'Logged out Successfully!', 'success')
        },
        CUSTOMERINIT(state, payload){
            state.customers = payload
        },
        DUECUSTOMERSINIT(state, payload){
          state.due_customers = payload.data
        },
        UNAUTHORIZED(state, payload){
            state.loading = false
            Vue.swal('Error!', payload, 'error')
        }
    },
    actions:{
        dueCustomersInit({commit}){
            axios({
                url: `${url}/api/get_due_costumers`,
                method:"get"
            }).then(res => {
                commit('DUECUSTOMERSINIT', res.data)
            }).catch(err => {
                console.log(err.response)
            })
        },
        login({state, commit}, payload){
            state.loading = true
            axios({
                url: `${url}/api/login`,
                method: "post",
                data: payload
            }).then(res => {
                commit('LOGIN', res.data.success)
            }).catch(err => {
                console.log(err)
                commit('UNAUTHORIZED', err.response.statusText)
            })
        },
        customerInit({commit, state}){
            axios({
                url: `${url}/api/customers`,
                method: "get",
            }).then(res => {
                commit('CUSTOMERINIT', res.data.data)
            }).catch(err => {
                console.log(err.response)
            })
        },
        checkAppStatus({commit}){
            let auth_user = JSON.parse(localStorage.getItem('auth_user', 0))
            if(auth_user != null){
                auth_user.relogin = true
                commit('LOGIN', auth_user)
            }
        },
        logout({commit}){
            commit('LOGOUT')
        }
    }
})
