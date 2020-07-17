<template>
<v-app id="forms-app">

		<v-navigation-drawer v-model="drawer" app :clipped="$vuetify.breakpoint.lgAndUp">
			<v-list nav dense>
				<v-list-item-group>
					<v-list-item  v-for="(menu, i) in menus" :key="i" :to="menu.url" dense style="text-decoration: none; color: inherit;">
						<v-list-item-icon>
							<v-icon>{{ menu.icon }}</v-icon>
						</v-list-item-icon>
						<v-list-item-content>
							<v-list-item-title v-text="menu.text"></v-list-item-title>
						</v-list-item-content>
					</v-list-item>
				</v-list-item-group>
			</v-list>

		</v-navigation-drawer>

		<v-app-bar dark app color="sast" elevate-on-scroll :clipped-left="$vuetify.breakpoint.lgAndUp" >
			<v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
			<v-icon class="mx-4" large>mdi-comment-question</v-icon>
			<v-toolbar-title > ZENTINEL - SAST </v-toolbar-title>
            <v-spacer></v-spacer>
			<v-btn icon :to="'/panel'">
				<v-icon>mdi-home</v-icon>
			</v-btn>
			<v-btn icon>
				<v-icon>mdi-bell</v-icon>
			</v-btn>
            <v-btn icon>
				<v-icon>mdi-logout</v-icon>
			</v-btn>
		</v-app-bar>

		<v-content>
			<v-container fluid>
				<router-view />
			</v-container>
		</v-content>

		<v-footer app color="sast" absolute class="font-weight-medium">
 			<v-col class="text-center" cols="12" >
        		{{ new Date().getFullYear() }} — <strong>DOJOES</strong>
      		</v-col>
		</v-footer>

	</v-app>
</template>
<script>
export default {
data: () => ({
		drawer: null,
		items: [
			{ title: "Dashboard", icon: "mdi-view-dashboard" },
			{ title: "Photos", icon: "mdi-image" },
			{ title: "About", icon: "mdi-help-box" }
		],
		menus: [
				{ icon: "mdi-home", url:'/panel', text: "Zentinel" },
				{ icon: "mdi-account-group", url:'/sast/users', text: "Usuarios" },
                { icon: "mdi-application", url:'/sast/solicitudes', text: "Solicitudes" },
                { icon: "mdi-sitemap", url:'/sast/categories', text: "Categorias" },
                { icon: "mdi-account-hard-hat", url:'/sast/tecnicos', text: "Tecnicos" },
                { icon: "mdi-help-circle", url:'/help', text: "Help" },
                { icon: "mdi-application", url:'/apps', text: "App DOJO" },
                { icon: "mdi-cogs", url:'/settings', text: "Settings" },
            ],
		icons: ["mdi-facebook", "mdi-twitter", "mdi-linkedin", "mdi-instagram"],
		color: "primary",
		colors: ["primary", "blue", "success", "red", "teal"],
		right: false,
		permanent: true,
		miniVariant: false,
		expandOnHover: false,
		background: false
	}),
}
</script>