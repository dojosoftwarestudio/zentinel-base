<template>
    <v-card>
        <v-toolbar >
            <v-toolbar-title>Mis Solicitudes</v-toolbar-title>
            <v-spacer></v-spacer>
            <FormSolicitud @list="list()"></FormSolicitud>
        </v-toolbar>
 <v-data-table
    :headers="table.headers"
    :items="table.items"
    :expanded.sync="expanded"
    :single-expand="singleExpand"
    item-key="codigo"
    show-expand
    class="elevation-1"
  >
    <template v-slot:item.estado="{ item }">
      <v-chip :color="item.color" dark>{{ item.codigo_descripcion }}</v-chip>
    </template>

    <template v-slot:expanded-item="{ headers, item }" class="elevation-1">
      <td :colspan="headers.length" color="primary">
         <v-card>
            <v-tabs
                v-model="tab"
                background-color="teal"
                centered
                dense
                dark
                icons-and-text
            >
            <v-tabs-slider></v-tabs-slider>
            <v-tab href="#tab-0">
                Detalle
                <v-icon>mdi-file-eye</v-icon>
            </v-tab>
            <v-tab href="#tab-1">
                Tecnico
                <v-icon>mdi-account-hard-hat</v-icon>
            </v-tab>

            <v-tab href="#tab-2">
                Eventos
                <v-icon>mdi-map-marker</v-icon>
            </v-tab>

            </v-tabs>
            <v-tabs-items v-model="tab">
                <v-tab-item value="tab-0">
                    <v-card  class="mx-auto"
                        color="default"
                        dark>
                        <v-card-title>
                          <v-icon
                            large
                            left>
                            mdi-twitter
                          </v-icon>
                          <span class="title font-weight-light">Detalle de solicitud</span>
                        </v-card-title>
                        <v-card-text class="font-weight-bold">
                            {{item.descripcion}}
                            <v-list>
                                   <v-btn :href='`${item.path}`' target="_blank" v-if="item.file">
                                       {{item.file}}
                                   </v-btn>
                            </v-list>
                        </v-card-text>
                        <v-card-actions>
                            <v-list-item class="grow">
                            <v-row
                              align="center"
                              justify="end">
                              <v-icon class="mr-1" @click="print(item)">mdi-printer</v-icon>
                            </v-row>
                        </v-list-item>
                        </v-card-actions>
                    </v-card>
                </v-tab-item>
                <v-tab-item value="tab-1">
                    <v-card dark color="gray">
                        <v-card-text>
                            <v-list two-line>
                              <v-list-item @click="">
                                <v-list-item-icon>
                                  <v-icon color="indigo">mdi-phone</v-icon>
                                </v-list-item-icon>

                                <v-list-item-content>
                                  <v-list-item-title>{{item.tecnico}}</v-list-item-title>
                                  <v-list-item-subtitle>Mobile</v-list-item-subtitle>
                                </v-list-item-content>

                                <v-list-item-icon>
                                  <v-icon>mdi-message-text</v-icon>
                                </v-list-item-icon>
                              </v-list-item>
                              <v-divider inset></v-divider>
                              <v-list-item @click="">
                                <v-list-item-icon>
                                  <v-icon color="indigo">mdi-email</v-icon>
                                </v-list-item-icon>

                                <v-list-item-content>
                                  <v-list-item-title>{{item.mail_tec}}</v-list-item-title>
                                  <v-list-item-subtitle>Personal</v-list-item-subtitle>
                                </v-list-item-content>
                              </v-list-item>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item value="tab-2">
                    <v-card dark color="gray">
                        <v-card-text>
                            <v-btn small @click="loadEventos(item.id_solicitud)">
                                loadEventos
                            </v-btn>
                        </v-card-text>
                        <v-stepper v-if="steps.length > 0">
                            <v-stepper-header>
                                <template v-for="(step, key) in steps">
                                    <v-stepper-step
                                        :key="`${key}-step`"
                                        :step="key"
                                        complete>
                                        Evento: {{step.detalle}}
                                        <small>categoria: {{step.categoria}}</small>
                                    </v-stepper-step>
                                    <v-divider
                                        v-if="key !== steps.length"
                                        :key="key"
                                        ></v-divider>
                                </template>
                            </v-stepper-header>
                        </v-stepper>
                    </v-card>
                </v-tab-item>
            </v-tabs-items>
        </v-card>
      </td>
    </template>
  </v-data-table>
    </v-card>
</template>
<script>
import FormSolicitud from './Solicitud'
export default {
    components:{
        FormSolicitud
    },
    data(){
        return{
            singleExpand:true,
            tab: null,
            url: '/public/upload/',
            steps: [],
            eventos : [],
            expanded: [],
            table:{
                headers:[
                    { text: 'Codigo', value: 'codigo'},
                    { text: 'Tecnico', value: 'tecnico' },
                    { text: 'Estado', value: 'estado' },
                    { text: 'Fecha Creación', value: 'created_at' },
                ],
                items: [],
                sort: 'created_at'
          },
        }
    },
    methods:{
        getColor (estado) {
            if (estado == 1) return 'green'
            else if (estado == 3) return 'orange'
            else return 'purple'
        },
        print: function(item){
            console.log("imprimir", item)
        },

        list: async function(){
            const rest = await this.callApi('get', '/api/solicitud/list','')
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
        loadEventos: async function(item){
            console.log(item)
            const rest = await this.callApi('get', '/api/solicitud/eventos/'+item, '')
            this.steps = await rest.data.data
        }
    },
    computed:{},
    created(){
       this.list()
    }
}
</script>