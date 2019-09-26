import Vue from 'vue'
import VueRouter from 'vue-router'
import Example from '../components/ExampleComponent.vue'

Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Example
        },
    ],
});
