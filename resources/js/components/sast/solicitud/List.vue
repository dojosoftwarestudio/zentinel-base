<template>
    <v-card>
        <v-toolbar >
            <v-toolbar-title>Available Solici</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn fab dark color="teal" small>
                <v-icon>mdi-plus</v-icon>
            </v-btn>
        </v-toolbar>
        <v-data-table :headers="headers" :items="elementsTable" :single-expand="singleExpand" :expanded.sync="expanded" show-expand>
            <template v-slot:expanded-item="{ headers, item }" @click="alert()">
                <td :colspan="headers.length">
                    <v-btn-toggle v-model="toggle_exclusive">
                        <v-btn color="white" @click="alert(item)">
                            <v-icon>mdi-format-italic</v-icon>
                        </v-btn>

                        <v-btn color="white">
                            <v-icon>mdi-format-bold</v-icon>
                        </v-btn>

                        <v-btn color="white">
                            <v-icon>mdi-format-underline</v-icon>
                        </v-btn>
                    </v-btn-toggle>
                </td>
            </template>

            <template v-slot:no-data>
                <v-btn color="primary" @click="list()">reload</v-btn>
            </template>
        </v-data-table>
    </v-card>
</template>
<script>

export default {

    data(){
        return{
            headers:[
                { text: "Name", align: "start", value: "name"},
                { text: "Email", value: "email" },
                { text: "status", value: "status" },
                { text: "Usuario", value: "user_mod" },
                { text: '', value: 'data-table-expand' },
            ],
            elementsTable:[],
            expanded: [],
            singleExpand: false,
        }
    },
    components:{

    },
    porps:{},
    methods:{
        // list: async function(){
        //     const rest = await this.callApi('get', '/api/auth/user/list','')
        //     this.elementsTable = rest.data
        // },
        // alert: function(item){
        //     console.log("desde ", item.id)
        // },
    },
    computed:{},
    created(){
    //    this.list()
    }
}
</script>