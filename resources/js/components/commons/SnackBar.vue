<template>
    <v-snackbar v-model="display" :timeout="timeout" :color="color" top right vertical style="z-index: 9999 !important">
        {{message}}
        <v-btn icon @click="display = false" >
            <v-icon>mdi-close-circle</v-icon>
        </v-btn>
    </v-snackbar>
</template>
<script>
export default {
    props:{
    },
    data(){
        return {
            display: '',
            timeout: 2000,
            color: '',
            message: '',
        }
    },
    methods:{
        open: function(config){
            this.display = true
            this.color = config.color === '' ? 'primary':config.color
            this.message = config.message === ''? 'Message' : config.message
        },
    },
}
</script>