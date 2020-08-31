<template>
    <v-card>
        <v-card-title>
            <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Buscar"
            single-line
            hide-details
            ></v-text-field>
        </v-card-title>
        <v-data-table
        :headers="table.headers"
        :items="table.items"
        :search="search"
        class="elevation-1"
        multi-sort
        sort-desc
        >
            <template v-slot:item="{ item }">
              <!-- PARA APLICAR ESTILOS POR ROW -->
              <!-- <tr :class="{'v-data-table__selected': item.estado === 'BORRADOR'}"> -->
                <tr>
                    <td v-for="header in table.headers" :key="header.value" >
                        <template v-if="header.type === 'date'">
                            {{ item[header.value] | formatDate}}
                        </template>
                        <template v-else-if="header.type === 'chip'">
                            <v-chip class="ma-2" label :color="getColor(item.estado_registro)" x-small dark>{{ item[header.value] }}</v-chip>
                        </template>
                        <template v-else-if="header.type === 'public'">
                            <v-chip class="ma-2" label :color="getColorPublic(item.publica)" x-small dark>{{ item[header.value] }}</v-chip>
                        </template>
                        <template v-else-if="header.type === 'prioridad'">
                            <v-chip class="ma-2" label :color="getColorPrioridad(item.prioridad)" x-small dark>{{ item[header.value] }}</v-chip>
                        </template>
                        <template v-else-if="header.type === 'actions'">
                            <v-tooltip top>
                                <template  v-slot:activator="{ on, attrs }">
                                    <v-icon
                                    small
                                    @click="$emit('edit-item',item)"
                                    v-bind="attrs"
                                    v-on="on"
                                    >
                                        mdi-pencil
                                    </v-icon>
                                </template>
                                <span>Modificar</span>
                            </v-tooltip>
                            <v-tooltip top>
                                <template  v-slot:activator="{ on, attrs }">
                                    <v-icon
                                    small
                                    @click="$emit('delete-item',item)"
                                    v-bind="attrs"
                                    v-on="on"
                                    >
                                        mdi-delete
                                    </v-icon>
                                </template>
                                <span>Eliminar</span>
                            </v-tooltip>
                            <v-tooltip top>
                                <template  v-slot:activator="{ on, attrs }">
                                    <v-icon
                                    small
                                    @click="$emit('detail-item',item)"
                                    v-bind="attrs"
                                    v-on="on"
                                    >
                                      mdi-cogs
                                    </v-icon>
                                </template>
                                <span>Detalle</span>
                            </v-tooltip>
                        </template>
                        <template v-else>
                          {{ item[header.value] }}
                        </template>
                    </td>
                </tr>
            </template>
            <template v-slot:no-data>
                <v-btn color="primary" @click="$emit('reload')">Recargar</v-btn>
            </template>
        </v-data-table>
    </v-card>
</template>

<script>
  export default {
    props: ['table'],
    data() {
      return {
        search: ''
      }
    },
    methods: {
        getColor(status){
            if (status === 'ACTIVO') return 'primary'
            else if (status === 'INACTIVO') return 'default'
            else return 'default'
        },
        getColorPublic(publica){
            if (publica === 'Si') return 'blue'
            else return 'default'
        },
        getColorPrioridad(prioridad){
            if (prioridad === 0) return 'blue'
            else if (prioridad === 1) return 'teal'
            else if (prioridad === 2) return 'pink'
            else if (prioridad === 3) return 'orange'
            else if (prioridad === 4) return 'green'
            else if (prioridad === 5) return 'cyan'
            else if (prioridad === 6) return 'cyan'
        }
    }
  }
</script>