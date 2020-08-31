<template>
    <v-card>
        <v-toolbar >
            <v-toolbar-title>Category</v-toolbar-title>
            <v-spacer></v-spacer>
            <Form @list="list()"></Form>

        </v-toolbar>
        <table-component
          :table="table"
          @edit-item="editItem"
          @delete-item="deleteItem"
          @detail-item="detailItem"
        ></table-component>
    </v-card>
</template>
<script>
import Form from './Form'
export default {
  components:{
    Form
  },
data(){
        return{
             table:{
              headers:[
                { text: 'Acciones', value: 'actions', type: 'actions'},
                { text: 'Nombre', value: 'nombre'},
                { text: 'Descripcion', value: 'descripcion' },
                { text: 'Prioridad', value: 'prioridad', type:'prioridad' },
                { text: 'Publica', value: 'publica', type:'public' },
                { text: 'Fecha Creación', value: 'created_at'},
              ],
              items: [],
              sort: 'created_at'
          },
        }
    },
    porps:{},
    methods:{
        list: async function(){
            const rest = await this.callApi('get', '/api/category/list','')
            if(rest.status === 200)
                this.table.items = rest.data.data
            else
                console.log("Error")
        },
        addItem: function(item){
        },
        editItem: function(item){
            console.log("desde ", item.id)
        },
        deleteItem: async function(item){
            // const data = {
            //     id: item.id_categoria
            // }
            // const rest = await this.callApi('delete', 'app/forms/delete', data)
            // if(rest.status === 200){
            //     this.message = "Eliminado con exito"
            //     this.configSnack.color="green"
            //     this.configSnack.message= `Eliminado con exito el registro ${this.form.name}`
            // }
            // else{
            //     this.message = "Error"
            //     this.configSnack.color="red"
            //     this.configSnack.message="Error"
            // }
            // this.dialog = false
            // this.$refs.snackbar.open(this.configSnack);
            // this.$emit('list')
        },
        detailItem: function(item){
            console.log("desde ", item.id)
        },
    },
    computed:{},
    created(){
       this.list()
    }
}
</script>