    <template>
      <v-row justify="center">
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
          <template v-slot:activator="{ on, attrs }">

          </template>
          <v-card >
            <v-toolbar dark color="dark">
              <v-btn icon dark @click="dialog = false">
                <v-icon>mdi-close</v-icon>
              </v-btn>
              <v-toolbar-title>{{codigo}}</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-toolbar-items>
                <v-btn dark icon @click="dialog = false"><v-icon>mdi-close</v-icon> </v-btn>
              </v-toolbar-items>
            </v-toolbar>

            <v-col cols="12">
              <v-card
                color="#385F73"
                dark
              >
                <v-card-title class="headline">{{solicitud.codigo}}</v-card-title>

                <v-card-subtitle>{{solicitud.descripcion}}</v-card-subtitle>

                <v-card-actions>
                  <v-list-item>
                <v-list-item-avatar color="grey darken-3">
                  <v-img
                    class="elevation-6"
                    src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
                  ></v-img>
                </v-list-item-avatar>
                 <v-list-item-content>
                  <v-list-item-title>{{solicitud.solicitante}}</v-list-item-title>
                </v-list-item-content>

                <v-row
                  align="center"
                  justify="end">
                <v-icon class="mr-1" v-if="solicitud.file">mdi-paperclip</v-icon>
                <span class="subheading mr-2">{{solicitud.file}}</span>

                  <v-icon class="mr-1">mdi-calendar</v-icon>
                  <span class="subheading mr-2">{{solicitud.created_at}}</span>
                </v-row>
                </v-list-item>
                </v-card-actions>
              </v-card>
            </v-col>

            <v-divider></v-divider>
            <v-col cols="12">
              <v-card color="primary" dark>
                  <v-tabs
                      v-model="tab"
                      background-color="deep-purple accent-4"
                      centered
                      dark
                      icons-and-text
                  >
                      <v-tabs-slider></v-tabs-slider>

                      <v-tab href="#tab-1">
                          FInalizar
                          <v-icon>mdi-check-underline-circle-outline</v-icon>
                      </v-tab>

                      <v-tab href="#tab-2">
                          Rechazar
                          <v-icon>mdi-trash-can-outline</v-icon>
                      </v-tab>

                      <v-tab href="#tab-3">
                          Derivar
                          <v-icon>mdi-page-next-outline</v-icon>
                      </v-tab>
                  </v-tabs>

                  <v-tabs-items v-model="tab">
                      <v-tab-item value="tab-1">
                          <v-card flat>
                              <v-card-text>
                                  <Finalizar @list="list()" :id="solicitud.id_solicitud"></Finalizar>
                              </v-card-text>
                          </v-card>
                      </v-tab-item>
                      <v-tab-item value="tab-2">
                          <v-card flat>
                              <v-card-text>
                                  <Rechazar @list="list()" :id="solicitud.id_solicitud"></Rechazar>
                              </v-card-text>
                          </v-card>
                      </v-tab-item>
                      <v-tab-item value="tab-3">
                          <v-card flat>
                              <v-card-text>
                                  <Derivar @list="list()" :id="solicitud.id_solicitud"></Derivar>
                              </v-card-text>
                          </v-card>
                      </v-tab-item>
                  </v-tabs-items>
              </v-card>
          </v-col>
          </v-card>
        </v-dialog>
      </v-row>
    </template>
    <script>
        import Finalizar from "./Finalizar";
        import Rechazar from "./Rechazar";
        import Derivar from "./Derivar";

     export default {
         components: {Finalizar, Derivar, Rechazar},
         data () {
          return {
            tab: null,
            codigo: '',
            dialog: false,
            solicitud:{},
          }
        },
        methods:{
          open: async function(codigo, id){
            this.dialog = true
            this.codigo = codigo
            const rest = await this.callApi('get', '/api/solicitud/'+id, '')
            this.solicitud = rest.data.solicitud[0]
          },
          list:function(){
              console.log("LISTAR")
          }
        }
      }
    </script>
