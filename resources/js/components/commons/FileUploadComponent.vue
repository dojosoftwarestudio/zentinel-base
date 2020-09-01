<template>
    <v-dialog
        v-model="upload.dialog"
        max-width="500"
    >
        <v-card>
            <v-card-title>
                Adjuntar Archivo Digital
            </v-card-title>

            <v-card-text>
                <v-file-input show-size label="Seleccionar Archivo" @change="preview" v-model="document"></v-file-input>
                <object :data="url" class="container"></object>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn
                    color="default"
                    text
                    @click="upload.dialog = false; url=null; document=null"
                >
                    Cancelar
                </v-btn>

                <v-btn
                    color="primary"
                    text
                    @click="upload.dialog = false"
                >
                    Guardar
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
    export default {
        props:['upload'],
        data(){
            return {
                document: null,
                url: null
            }
        },
        methods:{
            preview(e) {
                var _self = this;
                const reader = new FileReader();
                reader.onload = (e) => {
                    _self.url = e.target.result
                };
                reader.readAsDataURL(_self.document);
            }
        }
    }
</script>
