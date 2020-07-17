<template>
	<v-app id="inspire">


		<v-app-bar app color="primary" dark>
			<v-app-bar-nav-icon ></v-app-bar-nav-icon>
			<v-icon class="mx-4" large>mdi-monitor-eye</v-icon>
			<v-toolbar-title>Zentinel</v-toolbar-title>
			<v-spacer></v-spacer>
			<v-btn icon>
				<v-icon>mdi-apps</v-icon>
			</v-btn>
			<v-btn icon>
				<v-icon>mdi-bell</v-icon>
			</v-btn>
            <v-btn icon>
				<v-icon>mdi-logout</v-icon>
			</v-btn>
			<v-btn icon large>
				<v-avatar size="32px" item>
					<v-img src="https://cdn.vuetifyjs.com/images/logos/logo.svg" alt="Vuetify"></v-img>
				</v-avatar>
			</v-btn>
		</v-app-bar>

		<v-main>
			<v-container class="menu fill-height align-content-space-around flex-wrap" fluid>
				<v-row class="col-12">
					<v-tooltip bottom v-for="(item, i) in items" :key="i">
						<template v-slot:activator="{ on, attrs }" >
                            <v-card class="ma-2 col-md-2 col-xs-12 col-sm-4 col-lg-2" min-width="250" :color="item.color" dark>
                                <v-card-title>
                                    <v-toolbar-title>
                                        <v-icon large left>{{item.icon}}</v-icon>
                                        {{item.title}}
                                    </v-toolbar-title>
                                    <v-spacer></v-spacer>

                                </v-card-title>
                                <v-card-text class="">
                                    {{item.description}}
                                    <v-btn class="float-right" large fab :to="item.url" v-bind="attrs" v-on="on"  :color="item.color" >
                                        <v-icon>{{item.icon}}</v-icon>

                                    </v-btn>
                                </v-card-text>
                            </v-card>

						</template>
						<span>Ir al sistema</span>
					</v-tooltip>

				</v-row>
			</v-container>
		</v-main>
		<v-footer color="primary" app>
			<span class="white--text">DOJO SE &copy; 2020</span>
		</v-footer>
	</v-app>
</template>

<script>
export default {
	data() {
		return {
			drawer: null,
			items: [
				{
					title: "SAST",
					description: "app 1 description",
					icon: "mdi-comment-question",
                    color: "#f85a40",
                    url:"sast"
				},
				{
					title: "DOFORMS",
					description: "app 1 description",
					icon: "mdi-toy-brick",
                    color: "#c13832",
                    url:"doforms"
				},
				{
					title: "CMS",
					description: "app 1 description",
					icon: "mdi-trackpad",
                    color: "#f48924",
                    url:"cms"
				},
				{
					title: "GESDOC",
					description: "app 1 description",
					icon: "mdi-package",
                    color: "#ffc845",
                    url:"gesdoc"
                },
                {
					title: "COLLEGE",
					description: "app 1 description",
					icon: "mdi-school",
                    color: "#037ef3",
                    url:"gesdoc"
                },
                {
					title: "ACTIF",
					description: "app 1 description",
					icon: "mdi-table-chair",
                    color: "#0a8ea0",
                    url:"actif"
                },
                {
					title: "VENTAS",
					description: "app 1 description",
					icon: "mdi-point-of-sale",
                    color: "#52565e",
                    url:"gesdoc"
                },
                {
					title: "MONITOR",
					description: "app 1 description",
					icon: "mdi-contacts",
                    color: "#037ef3",
                    url:"gesdoc"
                },

			]
		};
	}
};
</script>