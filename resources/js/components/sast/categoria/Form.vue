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
        	Crear categoria
        </v-card-title>
        <v-card-text>
			<v-form ref="form" v-model="valid" lazy-validation>
			<v-row>
				<v-col cols="12" sm="6" md="12">
					<v-text-field class="mt-1" v-model="categoria.nombre" :counter="200" :rules="nameRules" label="Nombre" required ></v-text-field>
				</v-col>
				<v-col cols="12" sm="6" md="12">
					<v-text-field class="mt-1" v-model="categoria.descripcion" :counter="300"  label="Descripcion" required ></v-text-field>
				</v-col>
				<v-col cols="12" sm="6" md="12">
					<v-checkbox v-model="categoria.is_public" label="Publica?" value="Si"></v-checkbox>
				</v-col>
				<v-col cols="12" sm="6" md="12">
					<v-subheader class="pl-0">Prioridad</v-subheader>
			        <v-slider
			          v-model="categoria.prioridad"
			          :tick-labels="ticksLabels"
			          :max="4"
			          step="1"
			          tick-size="4"
			        ></v-slider>
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
    <snackbar ref="snackbar"></snackbar>
  </div>
</template>
<script>
 export default {
    data () {
		return {
			ticksLabels: [
	          'Baja',
	          'Media',
	          'Normal',
	          'Alta',
	          'Prioritaria'
	        ],
			show:false,
			valid:true,
			dialog: false,
			categoria:{
				id:'',
				nombre: '',
				prioridad:'',
				descripcion: '',
				is_public: '',
			},
			nameRules    : [
				v          => !!v || 'El nombre es requerido',
				v          => (v && v.length >= 5) || 'El nombre debe tener +5 caracteres'
			],
			configSnack: {
                color: '',
                message: '',
                display: '',
            },
		}
    },
    methods:{
    	save: async function(){

    		const rest = await this.callApi('post', '/api/category/create', this.categoria)
			if(rest.status !== 200){
    			this.clear()
    			this.configSnack.color = "green"
            	this.configSnack.message = `Creado con exito`

    		}else{
    			this.configSnack.color = "red"
            	this.configSnack.message = `Error al crear el elemento`
    		}
    		this.dialog = false
    		this.$refs.snackbar.open(this.configSnack)
    		this.$emit('list')
    	},
		clear: function(){
			this.$refs.form.reset()
			this.dialog = false
		},
    },
    computed:{
    },
    created(){
    }
  }
</script>