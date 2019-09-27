/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import router from './routes/routes'
import App from './components/App'
import vuetify from './plugins/vuetify'
import store from './plugins/store'
import * as VueGoogleMaps from 'vue2-google-maps'


require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueGoogleMaps, {
    load:{
        key: 'AIzaSyDfAlTFshIjpAoa4wV4wCTXS_1WSpqqlu8',
        libraries: 'places',
    }
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store,
    vuetify
});
