<template>
    <v-card>
        <v-toolbar >
            <v-toolbar-title>Atender</v-toolbar-title>
            <v-spacer></v-spacer>

        </v-toolbar>
       <table-component
          :table="table"
          @detail-item="detailItem"
        ></table-component>
        <Actions ref="actionsModal"></Actions>
    </v-card>

</template>
<script>
import Actions from './Actions'
export default {
    components:{
        Actions
    },
    data(){
        return{
            dialog: false,
             table:{
              headers:[
                { text: 'Codigo', value: 'codigo'},
                { text: 'Prioridad', value: 'prioridad'},
                { text: 'Categoria', value: 'categoria'},
                { text: 'Solicitante', value: 'solicitante' },
                { text: 'Fecha Creación', value: 'created_at' },
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
            const rest = await this.callApi('get', '/api/missolicitudes/2','')
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
            this.$refs.actionsModal.open(item.codigo, item.id_solicitud)
        },
    },
    computed:{},
    created(){
       this.list()
    }
}
</script>