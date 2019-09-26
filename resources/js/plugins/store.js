import Vue from 'vue'
import CollectorServices from '../src/services/CollectorServices'
import axios from "axios";
import Vuex from 'vuex'

Vue.use(Vuex)
let url = !process.env.IS_TEST ? 'http://localhost:8000' : 'https://mighty-savannah-84780.herokuapp.com'

export default new Vuex.Store({
    state:{
        loading: false,
        drawer:false,
        loggedIn: false,
        auth_user:{
            user:{},
            token:''
        }
    },
    mutations:{
        LOGIN(state, payload){
            state.auth_user.user = payload.user
            state.auth_user.token = payload.token
            state.loading = false
            setTimeout(() => {
                state.loggedIn = true
            }, 500);
            state.drawer = true
            localStorage.setItem('auth_user', JSON.stringify(payload))
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
        }
    },
    actions:{
        login({state, commit}, payload){
            state.loading = true
            axios({
                url: `${url}/api/login`,
                method: "post",
                data: payload
            }).then(res => {
                commit('LOGIN', res.data.success)
            })
        },
        checkAppStatus({commit}){
            let auth_user = localStorage.getItem('auth_user', 0)
            if(auth_user != null) commit('LOGIN', JSON.parse(auth_user))
        },
        logout({commit}){
            commit('LOGOUT')
        }
    }
})
