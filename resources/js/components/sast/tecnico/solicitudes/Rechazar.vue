<template>
    <v-card>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation
        >
            <v-textarea
                v-model="rechazado.descripcion"
                outlined
                name="descripcion"
                label="Descripcion"
            ></v-textarea>
            <v-col class="text-right mt-4" cols="12" sm="12" md="12">
                <v-btn @click="clear()" color="red" dark small fab>
                    <v-icon>mdi-trash-can</v-icon>
                </v-btn>
                <v-btn @click="save()" color="green" dark small fab>
                    <v-icon>mdi-send</v-icon>
                </v-btn>
            </v-col>
            <snackbar ref="snackbar"></snackbar>
        </v-form>
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
                rechazado:{
                    id : '',
                    descripcion: ''
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
                this.rechazado.id_tecnico = "2"
                this.rechazado.id = this.id
                const rest = await this.callApi('post', '/api/tecnico/rechazar', this.rechazado)
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

