<template>
    <v-card>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation
        >
            <v-select
                v-model="derivado.id_categoria"
                :items="categorias"
                append-outer-icon="mdi-sitemap"
                chip
                label="Seleccione una categoria"
                item-text="nombre"
                item-value="idCategoria"
            ></v-select>
            <v-textarea
                v-model="derivado.descripcion"
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
        </v-form>
    </v-card>
</template>

<script>
    export default {
        name: "Derivar",
        props:{
            id:{type:Number}
        },
        data(){
            return {
                valid: false,
                categorias:[],
                derivado:{
                    id : '',
                    descripcion: '',
                    id_categoria: '',
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
                this.derivado.id_tecnico = "2"
                this.derivado.id = this.id
                const rest = await this.callApi('post', '/api/tecnico/derivar', this.derivado)
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
            clear:function(){},
            listCategorias: async function(){
                const rest = await this.callApi('get','/api/category/list',null)
                this.categorias = rest.data.data
            },
        },

        mounted(){
            this.listCategorias()
        }
    }
</script>

<style scoped>

</style>

