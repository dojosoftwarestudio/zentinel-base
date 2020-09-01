    <template>
        <v-card>
            <v-form
                ref="form"
                v-model="valid"
                lazy-validation
            >
                <v-textarea
                    v-model="finalizado.descripcion"
                    outlined
                    name="descripcion"
                    label="Descripcion"
                ></v-textarea>
                <v-file-input
                    v-model="finalizado.file"
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
                <v-col class="text-right mt-4" cols="12" sm="12" md="12">
                    <v-btn @click="clear()" color="red" dark small fab>
                        <v-icon>mdi-trash-can</v-icon>
                    </v-btn>
                    <v-btn @click="save()" color="green" dark small fab>
                        <v-icon>mdi-send</v-icon>
                    </v-btn>
                </v-col>
            </v-form>
            <snackbar ref="snackbar"></snackbar>
        </v-card>
    </template>

    <script>
        export default {
            name: "Finalizar",
            props:{
                id:{type:Number}
            },
            data(){
                return {
                    valid: false,
                    files:[],
                    finalizado:{
                        id : '',
                        descripcion: '',
                        files:[],
                    },
                    configSnack: {
                        color: '',
                        message: '',
                        display: '',
                    },
                    upload: {
                        dialog: false
                    },
                    actions: {
                        disabled: false
                    },
                }
            },
            methods:{
                save: async function(){
                    this.finalizado.id_tecnico = "2"
                    this.finalizado.id = this.id
                    const rest = await this.callApi('post', '/api/tecnico/finalizar', this.finalizado)
                    console.log(rest)
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
                clear:function(){}
            },

            mounted(){
            }
        }
    </script>

    <style scoped>

    </style>
