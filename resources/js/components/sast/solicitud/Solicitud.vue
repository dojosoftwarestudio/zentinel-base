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
        <v-card-title class="sast" dark>
        	Solicitar atencion
        </v-card-title>

        <v-card-text>
			<v-form ref="form" v-model="valid" lazy-validation  enctype="multipart/form-data">
			<v-row>
				<v-col cols="12" sm="6" md="12">
					<v-select
                    v-model="solicitud.id_categoria"
                    :items="categorias"
                    append-outer-icon="mdi-sitemap"
                    chip
                    label="Seleccione una categoria"
                    item-text="nombre"
                    item-value="idCategoria"
                ></v-select>
				</v-col>
				<v-col cols="12" sm="6" md="12">
					<v-textarea
					v-model="solicitud.descripcion"
				      clearable
				      clear-icon="mdi-trash"
				      label="Detalle"
				      outlined
				      value=""
				    ></v-textarea>
				</v-col>
				<v-col cols="12" sm="6" md="12">
					<v-file-input
					    v-model="solicitud.file"
					    placeholder="Archivo"
					    label="Documento"
					    prepend-icon="mdi-paperclip"
					  >
					    <template v-slot:selection="{ text }">
					      <v-chip
					        small
					        label
					        color="primary"
					      >
					        {{ text }}
					      </v-chip>
					    </template>
					  </v-file-input>
				</v-col>
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
			show:false,
			valid:true,
			dialog: false,
			files:[],
			categorias:[],
			solicitud:{
				id_user: 11,
				id_categoria:'',
				estado:"0",
				descripcion:'',
				file:[]
			},
			configSnack: {
                color: '',
                message: '',
                display: '',
            },
		}
    },
    methods:{
    	save: async function(){
    		let formData = new FormData()
    		formData.append("id_user",this.solicitud.id_user)
    		formData.append("id_categoria",this.solicitud.id_categoria)
    		formData.append("descripcion",this.solicitud.descripcion)
    		formData.append("estado",this.solicitud.estado)
    		formData.append("file",this.solicitud.file)
    		formData.append("status",'activo')
    		formData.append("reg_del",0)
    		formData.append("user_mod",2)
    		console.log(formData)
    		const rest = await this.callApi('post', this.sirin.PREFIX_URI, 'solicitar', formData)
    		if(rest.status === 200){
    			this.clear()
    			this.configSnack.color = "green"
            	this.configSnack.message = `Creado con exito`
	    		this.dialog = false
    		}else{
    			this.configSnack.color = "red"
            	this.configSnack.message = `Error al crear el elemento`
    		}
    		this.$refs.snackbar.open(this.configSnack)
    		this.$emit('list')
    	},
		clear: function(){
			this.$refs.form.reset()
			this.dialog = false
		},
		clear2: function(){
			this.$refs.form.resetValidation()
			this.dialog = false
		},
		listCategorias: async function(){
			const rest = await this.callApi('get',this.sirin.PREFIX_URI, 'category/list',null)
    		this.categorias = rest.data.data
		},
    },
    computed:{

    },
    created(){
    	this.listCategorias()

    }
  }
</script>
