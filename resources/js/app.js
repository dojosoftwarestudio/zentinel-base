require('./bootstrap')
window.Vue = require('vue')

import '@mdi/font/css/materialdesignicons.css'
import Vuetify from 'vuetify'
Vue.use(Vuetify)

import themeDojo from './themeDojo'
import router from './router'
import store from './store'
import common from './commons'
Vue.mixin(common)


import Components from "./list-component/components";

router.beforeEach((to, from, next) =>{
    const requiresAuth = to.matched.some( record => record.meta.requiresAuth)
    const currentUser = store.state.currentUser
    if(requiresAuth && !currentUser){
        next('/')
    }else if(to.path == '/' && currentUser){
        next('/')
    }else{
        next()
    }
})

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        theme: {
            themes: {
                light: {
                    // primary: '#00334e',
                    primary: '#123962',
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
    store,
    router,
    icons: {
        iconfont: 'mdi',
    },

});