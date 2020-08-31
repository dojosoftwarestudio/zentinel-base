<template>
    <v-card>
        <v-toolbar >
            <v-toolbar-title> <v-icon>mdi-account-group</v-icon>  Usuarios </v-toolbar-title>
            <v-spacer></v-spacer>

          <FormUsuario></FormUsuario>
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
import FormUsuario from './FormUsuario'
export default {
  components:{
    FormUsuario
  },
    data(){
        return{
             table:{
              headers:[
                { text: 'Nombre', value: 'name'},
                { text: 'email', value: 'email' },
                { text: 'Fecha Creación', value: 'created' },
                { text: 'Acciones', value: 'actions', type: 'actions'}
              ],
              items: [],
              sort: 'created_at'
          },
        }
    },
    porps:{},
    methods:{
        list: async function(){
            const rest = await this.callApi('get', '/api/user/list','')
            this.table.items = rest.data.data
        },
        addItem: function(item){
        },
        editItem: function(item){
            console.log("desde ", item.id)
        },
        deleteItem: function(item){
            console.log("desde ", item.id)
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