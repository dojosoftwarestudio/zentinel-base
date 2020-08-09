<template>
	<v-app id="inspire">
		<v-main>
			<v-container class="fill-height" fluid>
				<v-row align="center" justify="center">
					<v-col cols="12" sm="8" md="4">
						<v-card class="elevation-12">
							<v-toolbar color="primary" dark flat>
								<v-toolbar-title>ZENTINEL</v-toolbar-title>
								<v-spacer></v-spacer>
							</v-toolbar>
							<v-card-text>
								<v-form >
									<v-text-field label="Login" name="login" prepend-icon="mdi-account" type="text" v-model="form.email"></v-text-field>
									<v-text-field
										id="password"
										label="Password"
										name="password"
										prepend-icon="mdi-lock"
										type="password"
										 v-model="form.password"
									></v-text-field>
									<v-spacer></v-spacer>
								<v-btn color="primary" dark @click="authenticate">Login</v-btn>
								</v-form>
							</v-card-text>
							<v-card-actions>

							</v-card-actions>
						</v-card>
					</v-col>
				</v-row>
			</v-container>
		</v-main>
		<!-- <router-view> -->
	</v-app>
</template>

<script>
import {login} from '../helpers/auth'

	export default {
		name:"login",
		data(){
			return {
				form:{
					email: '',
					password: ''
				},
				errors: null
			}
		},
		methods:{
			authenticate:function(){
				this.$store.dispatch('login')
				console.log(this.$data.form)
	            login(this.$data.form)
                .then((res) => {
                    this.$store.commit('loginSuccess', res)
                    this.$router.push('/panel')
                })
                .catch((error) => {
                    this.$store.commit('loginFailed', {error})
                })
			}
		}
	}
</script>