require('./bootstrap')
window.Vue = require('vue')

import '@mdi/font/css/materialdesignicons.css'
import Vuetify from 'vuetify'
Vue.use(Vuetify)

import themeDojo from './themeDojo'
import router from './router'

Vue.component('login-component', require('./components/LoginComponent.vue').default)
Vue.component('PanelComponent', require('./components/PanelComponent.vue').default)

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        theme: {
            themes: {
                light: {
                    primary: '#30c39e',
                    secondary: '#28353d',
                    accent: '#222b30',
                    error: '#e55e5e',
                    basic: '#f3f4f4',
                    menu: '#f3f4f7',
                    sast: '#f85a40',
                    actif: '#0a8ea0'  ,
                    doforms: '#4d4e53'

                },
            }
        }
    }),
    router,
    icons: {
        iconfont: 'mdi', // default - only for display purposes
    },

});