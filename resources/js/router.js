import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import panel from './components/PanelComponent'
import login from './components/LoginComponent'

// SAST
import SastPanel  from './components/sast/welcome'
import SastUsuarios from './components/sast/usuario/List'
import SastSolicitudes from './components/sast/solicitud/List'
import SastCategories from './components/sast/categoria/List'
import SastTecnicos from './components/sast/tecnico/List'

//ACTIF
import ActifPanel from './components/actif/welcome'

const routes = [
    {
        path: '/',
        component: login
    },
    {
        path: '/panel',
        component: panel
    },
    {
        path: '/sast',
        component: SastPanel,
        children: [
            { path: 'users', component: SastUsuarios },
            { path: 'solicitudes', component: SastSolicitudes },
            { path: 'categories', component: SastCategories },
            { path: 'tecnicos', component: SastTecnicos },
        ]
    },
    {
        path: '/actif',
        component: ActifPanel,
        children: [
            { path: 'users', component: SastUsuarios },
            { path: 'solicitudes', component: SastSolicitudes },
            { path: 'categories', component: SastCategories },
            { path: 'tecnicos', component: SastTecnicos },
        ]
    }

]

export default new Router({
    mode: 'history',
    routes
})