import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

import {getLocalUser} from './helpers/auth'
const user = getLocalUser()

export default new Vuex.Store({
	state:{
		currentUser: user,
		isLoggedIn: !!user,
		loading: false,
		auth_error: null
	},
	getters:{
		isLoading(state){
			return state.loading
		},
		isLoggedIn(state) {
			return state.isLoggedIn
		},
		currentUser(state) {
			return state.currentUser
		},
		authError(state) {
			return state.auth_error
		}
	},
	mutations:{
		login(state){
			state.loading = true
			state.auth_error = null
		},
		loginSuccess(state, payload) {
			state.isLoggedIn = true
			state.loading = false
			state.auth_error = null
			state.currentUser = Object.assign({}, payload.user, {token: payload.access_token})
			localStorage.setItem("user", JSON.stringify(state.currentUser))
		},
		loginFailed(state, payload) {
			state.loading = false
			state.auth_error = payload.error
		},
		logout(state){
			localStorage.removeItem('user')
			state.isLoggedIn = false
			state.currentUser = null
		}
	},
	actions:{
		login(context){
			context.commit("login")
		}
	}

})