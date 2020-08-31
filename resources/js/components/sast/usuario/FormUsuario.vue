<template>
<div class="text-center">
    <v-dialog
      v-model="dialog"
      width="500"
    >
      <template v-slot:activator="{ on, attrs }">
      	<v-btn fab dark color="teal" small
      		v-bind="attrs"
          	v-on="on">
                <v-icon>mdi-plus</v-icon>
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="sast">
        </v-card-title>

        <v-card-text>
			<v-form ref="form" v-model="valid" lazy-validation>
			<v-row>
				<v-col cols="12" sm="6" md="12">
					<!-- <v-select class="mt-1" v-model="types_forms_id" :items="typesForms" item-text="name" item-value="id" :rules="typeRules" label="Tipo Formulario" required dense solo></v-select> -->
					<v-select
			          v-model="persona_id"
			          :items="personas"
			          append-outer-icon="mdi-account"
			          chip
			          label="Seleccione una Persona"
			          item-text="fullname"
			          item-value="id"
			        ></v-select>
				</v-col>
				<v-col cols="12" sm="6" md="12">
					<v-text-field class="mt-1" v-model="usuario.name" :counter="200" :rules="nameRules" label="Username" required ></v-text-field>
				</v-col>
				<v-col cols="12" sm="6" md="12">
					<v-text-field :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'" class="mt-1" v-model="usuario.password" label="Password" :rules="passwordRules" required :type="show ? 'text':'password'" @click:append="show = !show"></v-text-field>
				</v-col>
				<v-col cols="12" sm="6" md="12">
					<v-text-field class="mt-1" v-model="usuario.email" label="Email" :rules="emailRules" required ></v-text-field>
				</v-col>
				<v-col cols="12" sm="6" md="12">
					<v-select
				      v-model="rol_id"
				      :items="roles"
				      label="Seleccione Rol"
    				  chips
				      multiple
				      item-text="nombre"
				      item-value="id" >
				     <template v-slot:prepend-item>
				        <v-list-item
				          ripple
				          @click="toggle"
				        >
				          <v-list-item-action>
				            <v-icon :color="roles.length > 0 ? 'indigo darken-4' : ''">{{ icon }}</v-icon>
				          </v-list-item-action>
				          <v-list-item-content>
				            <v-list-item-title>Select All</v-list-item-title>
				          </v-list-item-content>
				        </v-list-item>
				        <v-divider class="mt-2"></v-divider>
				      </template>
				    </v-select>
				</v-col>
				<v-col cols="12" sm="6" md="12">
					<!-- <v-switch
					inset
					color="primary"
					v-model="usuario.estado"
					:value="activo"
					:label="`Switch 1: ${usuario.estado.toString()}`"
					></v-switch> -->
				</v-col>
				<v-divider></v-divider>
				<v-col class="text-right mt-4" cols="12" sm="12" md="12">
					<v-btn @click="clear()" color="red" dark small fab>
						<v-icon>mdi-close</v-icon>
					</v-btn>
					<v-btn @click="save()" color="green" dark small fab>
						<v-icon>mdi-check</v-icon>
					</v-btn>
				</v-col>
			</v-row>
			</v-form>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
 export default {
    data () {
		return {
			show:false,
			valid:true,
			dialog: false,
			rol_id:[],
			roles:[],
			personas:[],
			persona_id:'',
			usuario:{
				idUser: '',
				name: '',
				email: '',
				password:'',
				estado: 'activo',
			},
			nameRules    : [
				v          => !!v || 'El nombre es requerido',
				v          => (v && v.length >= 5) || 'El nombre debe tener +5 caracteres'
			],
			passwordRules    : [
					v          => !!v || 'Pasword es requerido',
					v          => (v && v.length >= 5) || 'El password debe tener +5 caracteres'
				],
			emailRules    : [
					v          => !!v || 'Email es requerido',
				],
		}
    },
    methods:{
    	save: function(){
    	},
		clear: function(){
			this.$refs.form.reset()
			this.usuario.name = ''
			this.usuario.email = ''
			this.dialog = false
		},
		clear2: function(){
			this.$refs.form.resetValidation()
			this.dialog = false
		},
		listPersonas: async function(){
			const rest = await this.callApi('get','/api/persona/list',null)
    		this.personas = rest.data.list
		},
		listRoles: async function(){
			const rest = await this.callApi('get','/api/rol/list',null)
    		this.roles = rest.data.data
		},
		toggle () {
        this.$nextTick(() => {
          if (this.allRols) {
            this.rol_id = []
          } else {
            this.rol_id = this.roles.slice()
          }
        })
      },
    },
    computed:{
	 allRols () {
        return this.roles.length === this.rol_id.length
      },
      seleccionarRoles () {
        return this.roles.length > 0 && !this.allRols
      },
      icon () {
        if (this.allRols) return 'mdi-close-box'
        if (this.seleccionarRoles) return 'mdi-minus-box'
        return 'mdi-checkbox-blank-outline'
      },
    },
    created(){
    	this.listPersonas()
    	this.listRoles()
    }
  }
</script>