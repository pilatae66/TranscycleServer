import Vue from 'vue'
import VueRouter from 'vue-router'
import GMap from '../components/Map.vue'

Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/map',
            name: 'map',
            component: GMap
        },
    ],
});
