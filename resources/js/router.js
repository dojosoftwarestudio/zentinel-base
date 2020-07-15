import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import panel from './components/PanelComponent'
import login from './components/LoginComponent'


const routes = [
    {
        path: '/panel',
        component: panel
    },
    {
        path: '/login',
        component: login
    }
]

export default new Router({
    mode: 'history',
    routes
})